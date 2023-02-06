<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::all();

        if (request()->type == 'datatable') {
            return datatables()->of($employee)
                ->addIndexColumn()
                ->addColumn('status', function (Employee $employee) {
                    if ($employee->isaktif == 1) {
                        $st = '<div class="badge badge-primary">Active</div>';
                        return $st;
                    }
                    $st = '<div class="badge badge-danger">Not Active</div>';
                    return $st;
                })
                ->addColumn('action', function ($employee) {
                    $view = '<a href="' . route('employee.edit', Crypt::encryptString($employee->id)) . '" class="btn btn-outline-primary">
                                <i class="fa fa-edit"></i></a>';
                    return $view;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        //Sweet Alert
        if (session('success_message')) {
            Alert::success('Success!', session('success_message'));
        }

        return view('employee.index');
    }

    public function create()
    {
        if (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        return view('employee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'pob' => 'required',
            'dob' => 'required',
            'sex' => 'required',
            'telphone' => 'max:15'
        ], [
            'nik.required' => 'Masukkan NIK',
            'name.required' => 'Nama karyawan tidak boleh kosong',
            'pob.required' => 'Masukkan tempat lahir',
            'dob.required' => 'Masukkan tanggal lahir',
            'sex.required' => 'Pilih jenis kelamin',
        ]);

        $employee = new Employee();
        $employee->nik = $request->nik;

        if (Employee::where('nik', $employee->nik)->first() != null) {
            return redirect()->route('employee.create')->withErrorsMessage('NIK "' . $request->nik . '" Sudah Ada..!!');
        }

        $employee->create([
            'nik' => $request->nik,
            'name' => $request->name,
            'pob' => $request->pob,
            'dob' => $request->dob,
            'sex' => $request->sex,
            'address' => $request->address,
            'telphone' => $request->telphone,
            'isaktif' => 1,
        ]);

        return redirect()->route('employee')->withSuccessMessage('Data Success to Created');
    }

    public function edit($id)
    {
        $decryptID = Crypt::decryptString($id);

        $employee = Employee::find($decryptID);

        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'pob' => 'required',
            'dob' => 'required',
            'sex' => 'required',
            'telphone' => 'max:15'
        ], [
            'nik.required' => 'Masukkan NIK',
            'name.required' => 'Nama karyawan tidak boleh kosong',
            'pob.required' => 'Masukkan tempat lahir',
            'dob.required' => 'Masukkan tanggal lahir',
            'sex.required' => 'Pilih jenis kelamin',
        ]);

        $employee = Employee::find($id);

        $employee->update($request->all());

        return redirect()->route('employee')->withSuccessMessage('Data was Updated');
    }
}
