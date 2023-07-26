<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('dashboard.mail.index', [
            'mails' => Mail::where('contact_id', $user->id)->get(),
            'user' => $user,
            'adminMail' => Mail::all()
        ]);
    }

    public function openMail()
    {
        $userId = $_POST['userId'];
        $status = $_POST['status'];

        $contactId = Auth::user();

        $user = User::find($userId);
        $mail = Mail::where('user_id', $userId)->get();

        Mail::where('user_id', $user->id)->update([
            'status' => $status
        ]);

        $userIdDetail = $user->id;

        return view('dashboard.mail.detail', [
            'mails' => Mail::where('contact_id', $userIdDetail)->get()
        ]);
    }

    public function sendMail()
    {
        $user = Auth::user();

        // Mengambil nilai-nilai dari $_POST
        $status = $_POST['status'];
        $pesan = $_POST['pesan'];
        $contactId = $_POST['contactId'];
        $userId = $user->id;

        // Membuat array asosiatif untuk data yang akan divalidasi
        $dataToValidate = [
            'status' => $status,
            'pesan' => $pesan,
            'contact_id' => $contactId,
            'user_id' => $userId
        ];

        // Menentukan aturan validasi
        $rules = [
            'status' => 'required|max:20|string',
            'pesan' => 'required|max:255|string',
            'contact_id' => 'required|max:20|string',
            'user_id' => 'required|max:20|integer'
        ];

        // Melakukan validasi
        $validator = Validator::make($dataToValidate, $rules);

        // Memeriksa apakah validasi berhasil
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Mail::where('contact_id', $contactId)->update([
            'status' => $status
        ]);

        // Jika validasi berhasil, data akan disimpan ke dalam tabel Mail
        Mail::create($dataToValidate);

        return redirect('/dashboard/mail/detail/' . $contactId)->with('success', 'Mail terkirim!');
    }


    public function detail($contactId)
    {
        return view('dashboard.mail.detail', [
            'mails' => Mail::where('contact_id', $contactId)->get()
        ]);
    }


    public function createMail()
    {
        return view('dashboard.mail.create', [
            'users' => User::all(),
            'auth' => Auth::user()
        ]);
    }
}
