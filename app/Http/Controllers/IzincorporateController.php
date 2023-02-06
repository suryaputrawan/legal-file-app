<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use App\Models\IzinCorporate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class IzincorporateController extends Controller
{
    public function index()
    {
        $model = IzinCorporate::query();

        if (request()->type == 'datatable') {
            return datatables()->of($model)
                ->addIndexColumn()
                ->addColumn('penerbit', function (IzinCorporate $izinCorporate) {
                    return $izinCorporate->penerbit->name;
                })
                ->addColumn('unit', function (IzinCorporate $izinCorporate) {
                    return $izinCorporate->unit->alias;
                })
                ->addColumn('action', function (IzinCorporate $izinCorporate) {
                    $edit = '<a href="' . route('izinCorporate.edit', Crypt::encryptString($izinCorporate->id)) . '" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i></a>';
                    $view = '<a href="' . route('izinCorporate.show', Crypt::encryptString($izinCorporate->id)) . '" class="btn btn-outline-warning">
                                <i class="fas fa-eye"></i></a>';
                    return $edit . ' ' . $view;
                })
                ->editColumn('tglterbit', function (IzinCorporate $izinCorporate) {
                    $tgl = strtotime($izinCorporate->tglterbit);
                    $tglterbit = date('d M Y', $tgl);
                    return $tglterbit;
                })
                ->addColumn('tglexp', function (IzinCorporate $izinCorporate) {
                    $tgl = strtotime($izinCorporate->tglexp);
                    $tglexp = '<div class="badge badge-danger">' . date('d M Y', $tgl) . '</div>';
                    return $tglexp;
                })
                ->rawColumns(['penerbit', 'unit', 'action', 'tglexp'])
                ->make(true);
        }

        //Sweet Alert
        if (session('success_message')) {
            Alert::success('Success!', session('success_message'));
        } elseif (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        $date = Carbon::now('Singapore');
        // $subDate = $date->subDays(7);

        $izinCorp = IzinCorporate::whereDate('tglExp', $date)->count();

        if ($izinCorp != null) {
            Alert::info('PENTING !!!', 'Terdapat ' . $izinCorp . ' Surat Izin Corporate Yang akan kadaluwarsa');
        }

        return view('izinCorporate.index');
    }

    public function show($id)
    {
        $decryptID = Crypt::decryptString($id);
        $izinCorporate = IzinCorporate::find($decryptID);
        $unit = Unit::get();
        $penerbit = Penerbit::get();

        return view('izinCorporate.show', compact('izinCorporate', 'unit', 'penerbit'));
    }

    public function create()
    {
        $unit = Unit::get();
        $penerbit = Penerbit::get();

        if (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        return view('izinCorporate.create', compact('unit', 'penerbit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'nomor' => 'required|max:50',
            'penerbit_id' => 'required',
            'tglterbit' => 'required',
            'tglexp' => 'required',
            'picture_path' => request('picture_path') ? 'mimes:jpeg,png,gif,jpg' : '',
            'file_path' => request('file_path') ? 'mimes:csv,txt,xlx,xls,pdf' : '',
            'unit_id' => 'required'
        ], [
            'name.required' => 'Masukkan nama surat izin',
            'nomor.required' => 'Masukkan nomor izin yang terdapat pada surat',
            'penerbit_id.required' => 'Pilih nama yang menerbitkan izin',
            'tglterbit.required' => 'Masukkan tanggal terbit izin',
            'tglexp.required' => 'Masukkan tanggal exp izin',
            'unit_id.required' => 'Pilih nama unit'
        ]);

        $izinCorporate = new IzinCorporate();
        $izinCorporate->nomor = $request->nomor;

        if (IzinCorporate::where('nomor', $izinCorporate->nomor)->first() != Null) {
            return redirect()->route('izinCorporate.create')->withErrorsMessage('Nomor Izin "' . $request->nomor . '" yang anda masukkan sudah ada..!!');
        }

        $izinCorporate->create([
            'name' => request('name'),
            'nomor' => request('nomor'),
            'penerbit_id' => request('penerbit_id'),
            'tglterbit' => request('tglterbit'),
            'tglexp' => request('tglexp'),
            'unit_id' => request('unit_id'),
            //Membuat kondisi jika terdapat gambar maka lakukan simpan ke tempat yang ditentukan, jika tidak maka null
            'picture_path' => request('picture_path') ? request()->file('picture_path')->store('images/izinCorporate') : null,
            'file_path' => request('file_path') ? request()->file('file_path')->store('files/izinCorporate') : null,
        ]);

        return redirect()->route('izinCorporate')->withSuccessMessage('Data success to Created');
    }

    public function edit($id)
    {
        $decryptID = Crypt::decryptString($id);
        $izinCorporate = IzinCorporate::find($decryptID);
        $unit = Unit::get();
        $penerbit = Penerbit::get();

        return view('izinCorporate.edit', compact('izinCorporate', 'unit', 'penerbit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'nomor' => 'required|max:50',
            'penerbit_id' => 'required',
            'tglterbit' => 'required',
            'tglexp' => 'required',
            'picture_path' => request('picture_path') ? 'image|mimes:jpeg,png,gif,jpg' : '',
            'file_path' => request('file_path') ? 'mimes:csv,txt,xlx,xls,pdf,docx,doc' : '',
            'unit_id' => 'required'
        ], [
            'name.required' => 'Masukkan nama izin',
            'nomor.required' => 'Masukkan nomor izin yang terdapat pada surat',
            'penerbit_id.required' => 'Pilih nama yang menerbitkan izin',
            'tglterbit.required' => 'Masukkan tanggal terbit izin',
            'tglexp.required' => 'Masukkan tanggal exp izin',
            'unit_id.required' => 'Pilih nama unit'
        ]);

        $izinCorporate = IzinCorporate::find($id);

        //Membuat kondisi langsung mendelete gambar yang lama pada storage
        if (request('picture_path')) {
            Storage::delete($izinCorporate->picture_path);
            $picture = request()->file('picture_path')->store('images/izinCorporate');
        } elseif ($izinCorporate->picture_path) {
            $picture = $izinCorporate->picture_path;
        } else {
            $picture = null;
        }

        if (request('file_path')) {
            Storage::delete($izinCorporate->file_path);
            $file = request()->file('file_path')->store('files/izinCorporate');
        } elseif ($izinCorporate->file_path) {
            $file = $izinCorporate->file_path;
        } else {
            $file = null;
        }

        $izinCorporate->update([
            'name' => request('name'),
            'nomor' => request('nomor'),
            'penerbit_id' => request('penerbit_id'),
            'tglterbit' => request('tglterbit'),
            'tglexp' => request('tglexp'),
            'unit_id' => request('unit_id'),
            'picture_path' => $picture,
            'file_path' => $file
        ]);

        return redirect()->route('izinCorporate')->withSuccessMessage('Data was Updated');
    }

    public function downloadImage($id)
    {
        $decryptID = Crypt::decryptString($id);
        $izinCorporate = Izincorporate::find($decryptID);

        if ($izinCorporate->picture_path == null) {
            return redirect()->route('izinCorporate')->withErrorsMessage('Maaf tidak terdapat File foto atas data tersebut !!!');
        }

        return Storage::download($izinCorporate->picture_path);
    }

    public function downloadFile($id)
    {
        $decryptID = Crypt::decryptString($id);
        $izinCorporate = Izincorporate::find($decryptID);

        if ($izinCorporate->file_path == null) {
            return redirect()->route('izinCorporate')->withErrorsMessage('Maaf tidak terdapat File atas data tersebut !!!');
        }

        return Storage::download($izinCorporate->file_path);
    }
}
