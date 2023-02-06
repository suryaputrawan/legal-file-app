<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class SettingsController extends Controller
{
    public function index()
    {
        $model = User::query();

        if (request()->type == 'datatable') {
            return datatables()->of($model)
                ->addIndexColumn()
                ->addColumn('action', function (User $user) {
                    $edit = '<a href="' . route('settings.edit', Crypt::encryptString($user->id)) . '" class="btn btn-outline-primary">
                                <i class="fa fa-edit"></i></a>';
                    return $edit;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        //Sweet Alert
        if (session('success_message')) {
            Alert::success('Success!', session('success_message'));
        }

        return view('settingsUser.index');
    }

    public function edit($id)
    {
        $decryptID = Crypt::decryptString($id);
        $user = User::find($decryptID);

        return view('settingsUser.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $user = User::find($id);

        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'role' => request('role'),
        ]);

        return redirect()->route('settings')->withSuccessMessage('Data was Updated');
    }
}
