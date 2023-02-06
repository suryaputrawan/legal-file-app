<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class UnitController extends Controller
{
    public function index()
    {
        $unit = Unit::all();

        if (request()->type == 'datatable') {
            return datatables()->of($unit)
                ->addIndexColumn()
                ->addColumn('action', function ($unit) {
                    $view = '<a href="' . route('unit.edit', Crypt::encryptString($unit->id)) . '" class="btn btn-outline-primary">
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

        return view('unit.index');
    }

    public function create()
    {
        if (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        return view('unit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'alias' => 'required',
            'telphone' => 'max:15'
        ], [
            'name.required' => 'Nama Perusahaan tidak boleh kosong',
            'alias.required' => 'Alias Perusahan tidak boleh kosong',
        ]);

        $unit = new Unit();
        $unit->alias = $request->alias;

        if (Unit::where('alias', $unit->alias)->first() != null) {
            return redirect()->route('unit.create')->withErrorsMessage('Nama Alias "' . $request->alias . '" Sudah ada.. !!');
        }

        Unit::create($request->all());

        return redirect()->route('unit')->withSuccessMessage('Data Success to Created');
    }

    public function edit($id)
    {
        $decryptID = Crypt::decryptString($id);

        $unit = Unit::find($decryptID);

        return view('unit.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'alias' => 'required',
            'telphone' => 'max:15'
        ], [
            'name.required' => 'Nama Perusahaan tidak boleh kosong',
            'alias.required' => 'Alias Perusahan tidak boleh kosong',
        ]);

        $unit = Unit::find($id);

        $unit->update($request->all());

        return redirect()->route('unit')->withSuccessMessage('Data Was Updated');
    }
}
