<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        return view('dashboard/account-settings/change',[
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
        if($user['confPassword'] == $_POST['password']){
            $rules = [
                'name' => 'required|max:255',
                'username' => 'required|max:255',
                'email' => 'required|email:dns',
            ];

            if($_POST['newPassword'] == $_POST['newConfPassword']){
                $changePasswordRules = [
                    'password' => 'required|min:5|max:255'
                ];

                $validatedData = $request->validate($changePasswordRules);

                $newPassword = Hash::make($validatedData['password']);

                User::where('id', $user->id)->update([
                    'password' => $newPassword,
                    'confPassword' => $_POST['newPassword']
                ]);

                return redirect('/dashboard/account-settings/change')->with('success', 'Password berhasil di update!');

                die;
            } else {
                return back()->with('updateError', 'Password tidak valid');

                die;
            }

            $validatedData = $request->validate($rules);

            User::where('id', $user->id)->update($validatedData);

            return redirect('/dashboard/account-settings')->with('success', 'Account berhasil di update!');
        }else{
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
