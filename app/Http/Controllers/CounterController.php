<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class CounterController extends Controller
{
    public function index()
    {
        $counter = Counter::all();

        if (request()->type == 'datatable') {
            return datatables()->of($counter)
                ->addIndexColumn()
                ->addColumn('action', function ($counter) {
                    $view = '<a href="' . route('counter.edit', Crypt::encryptString($counter->id)) . '" class="btn btn-outline-primary">
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

        return view('counter.index');
    }

    public function create()
    {
        if (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        return view('counter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'telphone' => 'max:15'
        ], [
            'name.required' => 'Nama tidak boleh kosong'
        ]);

        $counter = new Counter();
        $counter->name = $request->name;

        if (Counter::where('name', $counter->name)->first() != null) {
            return redirect()->route('counter.create')->withErrorsMessage('Nama Rekanan "' . $request->name . '" sudah ada..!!');
        }

        $counter->create($request->all());

        return redirect()->route('counter')->withSuccessMessage('Data success to Created');
    }

    public function edit($id)
    {
        $decryptID = Crypt::decryptString($id);

        $counter = Counter::find($decryptID);

        return view('counter.edit', compact('counter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'telphone' => 'max:15'
        ], [
            'name.required' => 'Nama tidak boleh kosong'
        ]);

        $counter = Counter::find($id);

        $counter->update($request->all());

        return redirect()->route('counter')->withSuccessMessage('Data was Updated');
    }
}
