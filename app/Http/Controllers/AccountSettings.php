<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountSettings extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard/account-settings/index', [
            'user' => User::where('id', auth()->user()->id)->first()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function show()
    {
        return view('dashboard/account-settings/change', [
            'user' =>  User::where('id', auth()->user()->id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::find($_POST['id']);

        if (array_key_exists('newPassword', $_POST) && array_key_exists('newConfPassword', $_POST)) {
            if ($_POST['newPassword'] == $_POST['newConfPassword']) {
                $changePasswordRules = [
                    'newPassword' => 'required|min:5|max:255',
                ];

                $validatedPassword = $request->validate($changePasswordRules);

                $newPassword = Hash::make($validatedPassword['newPassword']);

                User::where('id', $user->id)->update([
                    'password' => $newPassword,
                    'confPassword' => $_POST['newPassword']
                ]);

                return redirect('/dashboard/account-settings/change')->with('success', 'Password berhasil di update!');
            } else {
                return back()->with('updateError', 'Password tidak valid');
            }
        }

        if ($user['confPassword'] == $_POST['password']) {
            $rules = [
                'name' => 'required|max:255',
                'username' => 'required|max:255',
                'email' => 'required|email:dns',
                'image' => 'image|file|max:1024'
            ];

            $validatedData = $request->validate($rules);

            if($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $validatedData['image'] = $request->file('image')->store('user-images');
            }

            User::where('id', $user->id)->update($validatedData);

            return redirect('/dashboard/account-settings')->with('success', 'Account berhasil di update!');
        } else {
            return back()->with('updateError', 'Password tidak valid');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
