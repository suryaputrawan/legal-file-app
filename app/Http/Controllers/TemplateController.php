<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TemplateController extends Controller
{
    public function index()
    {
        $model = Template::query();

        if (request()->type == 'datatable') {
            return datatables()->of($model)
                ->addIndexColumn()
                ->addColumn('category', function (Template $template) {
                    return $template->category->name;
                })
                ->addColumn('action', function (Template $template) {
                    if (auth()->user()->role == "Admin" || auth()->user()->role == "Legal") {
                        $edit = '<a href="' . route('template.edit', Crypt::encryptString($template->id)) . '" class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i></a>';
                    } else {
                        $edit = '';
                    }
                    $download = '<a href="' . route('template.download', Crypt::encryptString($template->id)) . '" class="btn btn-outline-warning">
                                <i class="fas fa-download"></i></a>';

                    return $edit . ' ' . $download;
                })
                ->addColumn('files', function (Template $template) {
                    if ($template->file_path != null) {
                        $file = '<div class="badge badge-primary">File Available</div>';
                        return $file;
                    }
                    $file = '<div class="badge badge-danger">No File</div>';
                    return $file;
                })
                ->rawColumns(['category', 'files', 'action'])
                ->make(true);
        }

        //Sweet Alert
        if (session('success_message')) {
            Alert::success('Success!', session('success_message'));
        } elseif (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        return view('letterTemplate.index');
    }

    public function create()
    {
        $category = Category::get();

        if (session('errors_message')) {
            Alert::error('Errors !', session('errors_message'));
        }

        return view('letterTemplate.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'file_path' => request('file_path') ? 'mimes:csv,txt,xlx,xls,pdf,docx,doc' : '',
        ], [
            'name.required' => 'Masukkan nama template surat',
            'category.required' => 'Pilih salah satu category yang ada',
        ]);

        $template = new Template();
        $template->name = $request->name;

        if (Template::where('name', $template->name)->first() != Null) {
            return redirect()->route('template.create')->withErrorsMessage('Nama Template "' . $request->name . '"  yang anda masukkan sudah ada..!!');
        }

        $template->create([
            'name' => request('name'),
            'file_path' => request('file_path') ? request()->file('file_path')->store('files/templateLetter') : null,
            'category_id' => $request->category,
        ]);

        return redirect()->route('template')->withSuccessMessage('Data success to Created');
    }

    public function edit($id)
    {
        $decryptID = Crypt::decryptString($id);
        $template = Template::find($decryptID);
        $category = Category::get();

        return view('letterTemplate.edit', compact('template', 'category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'file_path' => request('file_path') ? 'mimes:csv,txt,xlx,xls,pdf,docx,doc' : '',
        ], [
            'name.required' => 'Masukkan nama template surat',
            'category_id.required' => 'Pilih salah satu category yang ada',
        ]);

        $template = Template::find($id);

        if (request('file_path')) {
            Storage::delete($template->file_path);
            $file = request()->file('file_path')->store('files/templateLetter');
        } elseif ($template->file_path) {
            $file = $template->file_path;
        } else {
            $file = null;
        }

        $template->update([
            'name' => request('name'),
            'category_id' => request('category_id'),
            'file_path' => $file
        ]);

        return redirect()->route('template')->withSuccessMessage('Data was Updated');
    }

    public function download($id)
    {
        $decryptID = Crypt::decryptString($id);
        $template = Template::find($decryptID);

        if ($template->file_path == null) {
            return redirect()->route('template')->withErrorsMessage('Maaf tidak terdapat File atas data tersebut !!!');
        }

        return Storage::download($template->file_path);
    }
}
