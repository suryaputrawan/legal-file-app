<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbit = Penerbit::all();

        if (request()->type == 'datatable') {
            return datatables()->of($penerbit)
                ->addIndexColumn()
                ->addColumn('action', function ($penerbit) {
                    $view = '<a href="' . route('penerbit.edit', Crypt::encryptString($penerbit->id)) . '" class="btn btn-outline-primary">
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

        return view('penerbit.index');
    }

    public function create()
    {
        if (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        return view('penerbit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'telphone' => 'max:15'
        ], [
            'name.required' => 'Nama tidak boleh kosong'
        ]);

        $penerbit = new Penerbit();
        $penerbit->name = $request->name;

        if (Penerbit::where('name', $penerbit->name)->first() != null) {
            return redirect()->route('penerbit.create')->withErrorsMessage('Nama Penerbit "' . $request->name . '" Sudah Ada..!');
        }

        Penerbit::create($request->all());

        return redirect()->route('penerbit.index')->withSuccessMessage('success', 'Data Success to Created');
    }

    public function edit($id)
    {
        $decryptID = Crypt::decryptString($id);

        $penerbit = Penerbit::find($decryptID);

        return view('penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'telphone' => 'max:15'
        ], [
            'nama.required' => 'Nama tidak boleh kosong'
        ]);

        $penerbit = Penerbit::find($id);

        $penerbit->update($request->all());

        return redirect()->route('penerbit.index')->withSuccessMessage('success', 'Data Success to Updated');
    }
}
