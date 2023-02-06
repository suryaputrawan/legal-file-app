<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();

        if (request()->type == 'datatable') {
            return datatables()->of($category)
                ->addIndexColumn()
                ->addColumn('action', function ($category) {
                    $view = '<a href="' . route('category.edit', Crypt::encryptString($category->id)) . '" class="btn btn-outline-primary">
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

        return view('category.index');
    }

    public function create()
    {
        if (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Masukkan nama categori',
        ]);

        $category = new Category();
        $category->name = $request->name;

        if (Category::where('name', $category->name)->first() != null) {
            return redirect()->route('category.create')->withErrorsMessage('Nama Category "' . $request->name . '" Sudah Ada..!');
        }

        Category::create($request->all());

        return redirect()->route('category')->withSuccessMessage('success', 'Data Success to Created');
    }

    public function edit($id)
    {
        $decryptID = Crypt::decryptString($id);
        $category = Category::find($decryptID);

        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Masukkan nama categori',
        ]);

        $category = Category::find($id);

        $category->update($request->all());

        return redirect()->route('category')->withSuccessMessage('Data Was Updated');
    }
}
