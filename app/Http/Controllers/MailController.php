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
            'mails' => Mail::where('recipient_id', $user->id)->get(),
        ]);
    }

    public function openMail()
    {
        $userId = request('userId');
        $status = request('status');

        $user = User::find($userId);

        Mail::where('user_id', $user->id)->update([
            'status' => $status
        ]);

        $userIdDetail = $user->id;

        if (Auth::user()->is_admin){
            return view('dashboard.mail.mailAdmin', [
                'penerima' => Mail::where('contact_id', Auth::user()->id)->get(),
            ]);
        } else {
            return view('dashboard.mail.mailUser', [
                'penerima' => Mail::where('contact_id', $userIdDetail)->get(),
            ]);
        }
    }

    public function detail($contactId)
    {
        $mails = Mail::where('contact_id', $contactId)->get();

        if (Auth::user()->is_admin) {
            return view('dashboard.mail.mailAdmin', [
                'pengirim' => $mails,
            ]);
        } else {
            return view('dashboard.mail.mailUser', [
                'penerima' => Mail::where('contact_id', $contactId)->get(),
            ]);
        }
    }


    public function sendMail()
    {

        $user = Auth::user();

        // Mengambil nilai-nilai dari $_POST

        $status = $_POST['status'];
        $pesan = $_POST['pesan'];
        $contactId = $_POST['contactId'];
        $recipientId = $_POST['recipientId'];
        $userId = $user->id;

        // Membuat array asosiatif untuk data yang akan divalidasi
        $dataToValidate = [
            'status' => $status,
            'pesan' => $pesan,
            'contact_id' => $contactId,
            'user_id' => $userId,
            'recipient_id' => $recipientId
        ];

        // Menentukan aturan validasi
        $rules = [
            'status' => 'required|max:20|string',
            'pesan' => 'required|string',
            'contact_id' => 'required|max:20|string',
            'user_id' => 'required|max:20|integer',
            'recipient_id' => 'required|max:20|integer'
        ];

        // Melakukan validasi
        $validator = Validator::make($dataToValidate, $rules);

        // Memeriksa apakah validasi berhasil
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Mail::where('contact_id', $contactId)->update([
            'status' => $status,
        ]);

        // Jika validasi berhasil, data akan disimpan ke dalam tabel Mail
        Mail::create($dataToValidate);

        return redirect('/dashboard/mail/detail/' . $contactId)->with('success', 'Mail terkirim!');
    }

    public function createMail()
    {
        return view('dashboard.mail.create', [
            'users' => User::all(),
            'auth' => Auth::user()
        ]);
    }

    public function destroy()
    {
        $contactId = $_POST['contactId'];
        if (Auth::user()->is_admin) {
            Mail::destroy($_POST['id']);
            return redirect('/dashboard/mail/detail/'.$contactId)->with('succes', 'Mail berhasil dihapus!');
        } else {
            Mail::destroy($_POST['id']);
            return redirect('/dashboard/mail/detail/'.$contactId)->with('succes', 'Mail berhasil dihapus!');
        }
    }
}
