<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Counter;
use App\Models\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AgreementController extends Controller
{
    public function index()
    {
        $model = Agreement::query();

        if (request()->type == 'datatable') {
            return datatables()->of($model)
                ->addIndexColumn()
                ->addColumn('counter', function (Agreement $agreement) {
                    return $agreement->counter->name;
                })
                ->addColumn('unit', function (Agreement $agreement) {
                    return $agreement->unit->alias;
                })
                ->addColumn('action', function (Agreement $agreement) {
                    $edit = '<a href="' . route('agreement.edit', Crypt::encryptString($agreement->id)) . '" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i></a>';
                    $view = '<a href="' . route('agreement.show', Crypt::encryptString($agreement->id)) . '" class="btn btn-outline-warning">
                                <i class="fas fa-eye"></i></a>';
                    return $edit . ' ' . $view;
                })
                ->editColumn('tglterbit', function (Agreement $agreement) {
                    $tgl = strtotime($agreement->tglterbit);
                    $tglterbit = date('d M Y', $tgl);
                    return $tglterbit;
                })
                ->addColumn('tglexp', function (Agreement $agreement) {
                    $tgl = strtotime($agreement->tglexp);
                    $tglexp = '<div class="badge badge-danger">' . date('d M Y', $tgl) . '</div>';
                    return $tglexp;
                })
                ->rawColumns(['counter', 'unit', 'action', 'tglexp'])
                ->make(true);
        }

        if (session('success_message')) {
            Alert::success('Success!', session('success_message'));
        } elseif (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        $date = Carbon::now('Singapore');
        //$subDate = $date->subDays(7);

        $agreement = Agreement::whereDate('tglExp', $date)->count();

        if ($agreement != null) {
            Alert::info('PENTING !!!', 'Terdapat ' . $agreement . ' Agreement Yang akan kadaluwarsa');
        }

        return view('agreement.index');
    }

    public function show($id)
    {
        $decryptID = Crypt::decryptString($id);
        $agreement = Agreement::find($decryptID);
        $unit = Unit::get();
        $counter = Counter::get();

        return view('agreement.show', compact('agreement', 'unit', 'counter'));
    }

    public function create()
    {
        $unit = Unit::all();
        $counter = Counter::all();

        if (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        return view('agreement.create', compact('unit', 'counter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'nomor' => 'required|max:50',
            'counter_id' => 'required',
            'tglterbit' => 'required',
            'tglexp' => 'required',
            'picture_path' => request('picture_path') ? 'image|mimes:jpeg,png,gif,jpg' : '',
            'file_path' => request('file_path') ? 'mimes:csv,txt,xlx,xls,pdf,docx,doc' : '',
            'unit_id' => 'required'
        ], [
            'name.required' => 'Masukkan nama surat perjanjian',
            'nomor.required' => 'Nomor Surat Perjanjian tidak boleh kosong',
            'counter_id.required' => 'Pilih salah satu nama counter yang ada',
            'tglterbit.required' => 'Tanggal terbit surat masih kosong',
            'tglexp.required' => 'Tanggal exp surat masih kosong',
            'unit_id.required' => 'Pilih salah satu nama unit yang ada'
        ]);

        $agreement = new Agreement();
        $agreement->nomor = $request->nomor;

        if (Agreement::where('nomor', $agreement->nomor)->first() != Null) {
            return redirect()->route('agreement.create')->withErrorsMessage('Nomor Perjanjian "' . $request->nomor . '" sudah ada..!!');
        }

        $agreement->create([
            'name' => request('name'),
            'nomor' => request('nomor'),
            'counter_id' => request('counter_id'),
            'tglterbit' => request('tglterbit'),
            'tglexp' => request('tglexp'),
            'unit_id' => request('unit_id'),
            //Membuat kondisi jika terdapat gambar maka lakukan simpan ke tempat yang ditentukan, jika tidak maka null
            'picture_path' => request('picture_path') ? request()->file('picture_path')->store('images/agreements') : null,
            'file_path' => request('file_path') ? request()->file('file_path')->store('files/agreements') : null,
        ]);

        return redirect()->route('agreement')->withSuccessMessage('Data success to Created');
    }

    public function edit($id)
    {
        $decryptID = Crypt::decryptString($id);
        $agreement = Agreement::find($decryptID);
        $unit = Unit::get();
        $counter = Counter::get();

        return view('agreement.edit', compact('agreement', 'unit', 'counter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'nomor' => 'required|max:50',
            'counter_id' => 'required',
            'tglterbit' => 'required',
            'tglexp' => 'required',
            'picture_path' => request('picture_path') ? 'image|mimes:jpeg,png,gif,jpg' : '',
            'file_path' => request('file_path') ? 'mimes:csv,txt,xlx,xls,pdf,docx,doc' : '',
            'unit_id' => 'required'
        ], [
            'name.required' => 'Masukkan nama surat perjanjian',
            'nomor.required' => 'Nomor Surat Perjanjian tidak boleh kosong',
            'counter_id.required' => 'Pilih salah satu nama counter yang ada',
            'tglterbit.required' => 'Tanggal terbit surat masih kosong',
            'tglexp.required' => 'Tanggal exp surat masih kosong',
            'unit_id.required' => 'Pilih salah satu nama unit yang ada'
        ]);

        $agreement = Agreement::find($id);

        //Membuat kondisi langsung mendelete gambar yang lama pada storage
        if (request('picture_path')) {
            Storage::delete($agreement->picture);
            $picture = request()->file('picture_path')->store('images/agreements');
        } elseif ($agreement->picture) {
            $picture = $agreement->picture;
        } else {
            $picture = null;
        }

        if (request('file_path')) {
            Storage::delete($agreement->file_path);
            $file = request()->file('file_path')->store('files/agreements');
        } elseif ($agreement->file_path) {
            $file = $agreement->file_path;
        } else {
            $file = null;
        }

        $agreement->update([
            'name' => request('name'),
            'nomor' => request('nomor'),
            'counter_id' => request('counter_id'),
            'tglterbit' => request('tglterbit'),
            'tglexp' => request('tglexp'),
            'unit_id' => request('unit_id'),
            'picture_path' => $picture,
            'file_path' => $file,
        ]);

        return redirect()->route('agreement')->withSuccessMessage('Data was Updated');
    }

    public function downloadImage($id)
    {
        $decryptID = Crypt::decryptString($id);
        $agreement = Agreement::find($decryptID);

        if ($agreement->picture_path == null) {
            return redirect()->route('agreement')->withErrorsMessage('Maaf tidak terdapat File foto atas data tersebut !!!');
        }
        return Storage::download($agreement->picture_path);
    }

    public function downloadFile($id)
    {
        $decryptID = Crypt::decryptString($id);
        $agreement = Agreement::find($decryptID);

        if ($agreement->file_path == null) {
            return redirect()->route('agreement')->withErrorsMessage('Maaf tidak terdapat File foto atas data tersebut !!!');
        }
        return Storage::download($agreement->file_path);
    }
}
