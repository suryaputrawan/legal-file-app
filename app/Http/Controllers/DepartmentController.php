<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::all();

        if (request()->type == 'datatable') {
            return datatables()->of($department)
                ->addIndexColumn()
                ->addColumn('action', function ($department) {
                    $view = '<a href="' . route('department.edit', Crypt::encryptString($department->id)) . '" class="btn btn-outline-primary">
                                <i class="fa fa-edit"></i></a>';
                    return $view;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        //Sweet Alert
        if (session('success_message')) {
            Alert::success('Success!', session('success_message'));
        }

        return view('department.index');
    }

    public function create()
    {
        if (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        return view('department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Nama Department tidak boleh kosong'
        ]);

        $department = new Department();
        $department->name = $request->name;

        if (Department::where('name', $department->name)->first() != null) {
            return redirect()->route('department.create')->withErrorsMessage('Nama Department "' . $request->name . '" sudah ada..!!');
        }

        $department->create($request->all());

        return redirect()->route('department')->withSuccessMessage('Data success to Created');
    }

    public function edit($id)
    {
        $decryptID = Crypt::decryptString($id);

        $department = Department::find($decryptID);

        return view('department.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Nama Department tidak boleh kosong'
        ]);

        $department = Department::find($id);

        $department->update($request->all());

        return redirect()->route('department')->withSuccessMessage('Data was Updated');
    }
}
