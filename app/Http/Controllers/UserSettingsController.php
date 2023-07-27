<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user-settings.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

     public function show(User $user)
     {
         return view('dashboard.user-settings.show', [
             'user' => $user
         ]);
     }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

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
        $admin = Auth::user();

        if(array_key_exists('newPassword', $_POST) && array_key_exists('newConfPassword', $_POST) && $admin['is_admin'] == 1){
            if($_POST['newPassword'] == $_POST['newConfPassword']){
                $changePasswordRules = [
                    'newPassword' => 'required|min:5|max:255'
                ];

                $validatedPassword = $request->validate($changePasswordRules);

                $newPassword = Hash::make($validatedPassword['newPassword']);

                User::where('id', $user['id'])->update([
                    'password' => $newPassword,
                    'confPassword' => $_POST['newPassword']
                ]);

                return back()->with('success', 'Password berhasil di update!');
            } else {
                return back()->with('updateError', 'Password tidak valid');
            }
        }

        $rules= [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email:dns'
        ];

        if($admin['is_admin'] == 1){
            $validatedData = $request->validate($rules);

            User::where('id', $user->id)->update($validatedData);

            return redirect()->route('user-settings.show', ['user' => $user->id])->with('success', 'Account berhasil di update!');
        } else {
            return back()->with('updateError', 'Data tidak valid');
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
        $user = $_POST['id'];
        User::destroy($user);
        return redirect('/dashboard/user-settings')->with('success', 'Data User has been deleted!');
    }

    public function change(User $user)
    {
        return view('dashboard.user-settings.change', [
            'user' => $user
        ]);
    }

    public function changePhoto(User $user)
    {
        return view('dashboard.user-settings.photo', [
            'user' => $user
        ]);
    }
}
