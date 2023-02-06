<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Employee;
use App\Models\IzinNakes;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class IzinnakesController extends Controller
{
    public function index()
    {
        $model = IzinNakes::query();

        if (request()->type == 'datatable') {
            return datatables()->of($model)
                ->addIndexColumn()
                ->addColumn('employee', function (IzinNakes $izinNakes) {
                    $action = '<div class="table-links">
                                <a href="' . route('izinNakes.show', Crypt::encryptString($izinNakes->id)) . '" class="text-primary">View</a>
                                <div class="bullet"></div>
                                <a href="' . route('izinNakes.edit', Crypt::encryptString($izinNakes->id)) . '" class="text-warning">Edit</a>
                              </div>';
                    return $izinNakes->employee->name . $action;
                })
                ->addColumn('department', function (IzinNakes $izinNakes) {
                    return $izinNakes->department->name;
                })
                ->addColumn('unit', function (IzinNakes $izinNakes) {
                    return $izinNakes->unit->alias;
                })
                ->editColumn('tglterbit', function (IzinNakes $izinNakes) {
                    $tgl = strtotime($izinNakes->tglterbit);
                    $tglterbit = date('d M Y', $tgl);
                    return $tglterbit;
                })
                ->addColumn('tglexp', function (IzinNakes $izinNakes) {
                    $tgl = strtotime($izinNakes->tglexp);
                    $tglexp = '<div class="badge badge-danger">' . date('d M Y', $tgl) . '</div>';
                    return $tglexp;
                })
                ->rawColumns(['department', 'employee', 'unit', 'tglexp'])
                ->make(true);
        }

        if (session('success_message')) {
            Alert::success('Success!', session('success_message'));
        } elseif (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        $date = Carbon::now('Singapore');
        //$subDate = $date->subDays(7);

        $izinNakes = IzinNakes::whereDate('tglExp', $date)->count();

        if ($izinNakes != null) {
            Alert::info('PENTING !!!', 'Terdapat ' . $izinNakes . ' Surat Izin Nakes Yang akan kadaluwarsa');
        }

        return view('izinNakes.index');
    }

    public function show($id)
    {
        $decryptID = Crypt::decryptString($id);
        $izinNakes = IzinNakes::find($decryptID);
        $unit = Unit::get();
        $employee = Employee::get();
        $department = Department::get();

        return view('izinNakes.show', compact('izinNakes', 'unit', 'employee', 'department'));
    }

    public function create()
    {
        $department = Department::get();
        $unit = Unit::get();
        $employee = Employee::where('isaktif', 1)->get();

        if (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        return view('izinNakes.create', compact('department', 'unit', 'employee'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|max:50',
            'employee_id' => 'required',
            'department_id' => 'required',
            'tglterbit' => 'required',
            'tglexp' => 'required',
            'picture_path' => request('picture_path') ? 'image|mimes:jpeg,png,gif,jpg' : '',
            'file_path' => request('file_path') ? 'mimes:csv,txt,xlx,xls,pdf,docx,doc' : '',
            'unit_id' => 'required'
        ], [
            'nomor.required' => 'Masukkan nomor izin yang terdapat pada surat',
            'employee_id.required' => 'Pilih nama karyawan',
            'department_id.required' => 'Pilih department',
            'tglterbit.required' => 'Masukkan tanggal terbit izin',
            'tglexp.required' => 'Masukkan tanggal exp izin',
            'unit_id.required' => 'Pilih nama unit'
        ]);

        $izinNakes = new IzinNakes();
        $izinNakes->nomor = $request->nomor;

        if (IzinNakes::where('nomor', $izinNakes->nomor)->first() != Null) {
            return redirect()->route('izinNakes.create')->withErrorsMessage('Nomor Izin "' . $request->nomor . '" yang anda masukkan sudah ada..!!');
        }

        $izinNakes->create([
            'nomor' => request('nomor'),
            'employee_id' => request('employee_id'),
            'department_id' => request('department_id'),
            'tglterbit' => request('tglterbit'),
            'tglexp' => request('tglexp'),
            'unit_id' => request('unit_id'),
            //Membuat kondisi jika terdapat gambar maka lakukan simpan ke tempat yang ditentukan, jika tidak maka null
            'picture_path' => request('picture_path') ? request()->file('picture_path')->store('images/izinNakes') : null,
            'file_path' => request('file_path') ? request()->file('file_path')->store('files/izinNakes') : null,
        ]);

        return redirect()->route('izinNakes')->withSuccessMessage('Data success to Created');
    }

    public function edit($id)
    {
        $decryptID = Crypt::decryptString($id);
        $izinNakes = IzinNakes::find($decryptID);
        $unit = Unit::get();
        $employee = Employee::where('isaktif', 1)->get();
        $department = Department::get();

        return view('izinNakes.edit', compact('izinNakes', 'unit', 'employee', 'department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor' => 'required|max:50',
            'employee_id' => 'required',
            'department_id' => 'required',
            'tglterbit' => 'required',
            'tglexp' => 'required',
            'picture_path' => request('picture_path') ? 'image|mimes:jpeg,png,gif,jpg' : '',
            'file_path' => request('file_path') ? 'mimes:csv,txt,xlx,xls,pdf,docx,doc' : '',
            'unit_id' => 'required'
        ], [
            'nomor.required' => 'Masukkan nomor izin yang terdapat pada surat',
            'employee_id.required' => 'Pilih nama karyawan',
            'department_id.required' => 'Pilih department',
            'tglterbit.required' => 'Masukkan tanggal terbit izin',
            'tglexp.required' => 'Masukkan tanggal exp izin',
            'unit_id.required' => 'Pilih nama unit'
        ]);

        $izinNakes = IzinNakes::find($id);

        //Membuat kondisi langsung mendelete gambar yang lama pada storage
        if (request('picture_path')) {
            Storage::delete($izinNakes->picture_path);
            $picture = request()->file('picture_path')->store('images/izinNakes');
        } elseif ($izinNakes->picture_path) {
            $picture = $izinNakes->picture_path;
        } else {
            $picture = null;
        }

        if (request('file_path')) {
            Storage::delete($izinNakes->file_path);
            $file = request()->file('file_path')->store('files/izinNakes');
        } elseif ($izinNakes->file_path) {
            $file = $izinNakes->file_path;
        } else {
            $file = null;
        }

        $izinNakes->update([
            'nomor' => request('nomor'),
            'employee_id' => request('employee_id'),
            'department_id' => request('department_id'),
            'tglterbit' => request('tglterbit'),
            'tglexp' => request('tglexp'),
            'unit_id' => request('unit_id'),
            'picture_path' => $picture,
            'file_path' => $file
        ]);

        return redirect()->route('izinNakes')->withSuccessMessage('Data was Updated');
    }

    public function downloadImage($id)
    {
        $decryptID = Crypt::decryptString($id);
        $izinNakes = IzinNakes::find($decryptID);

        if ($izinNakes->picture_path == null) {
            return redirect()->route('izinNakes')->withErrorsMessage('Maaf tidak terdapat File foto atas data tersebut !!!');
        }

        return Storage::download($izinNakes->picture_path);
    }

    public function downloadFile($id)
    {
        $decryptID = Crypt::decryptString($id);
        $izinNakes = IzinNakes::find($decryptID);

        if ($izinNakes->file_path == null) {
            return redirect()->route('izinNakes')->withErrorsMessage('Maaf tidak terdapat File atas data tersebut !!!');
        }

        return Storage::download($izinNakes->file_path);
    }
}
