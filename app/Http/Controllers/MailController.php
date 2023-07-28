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
        $user = Auth::user()->id;

        $mails = Mail::where('sender_id', $user)->orWhere('receiver_id', $user)->get();

        return view('dashboard.mail.index', [
            'mails' => $mails
        ]);
    }


    public function openMail($chatId)
    {
        $chatId = request('chatId');

        $dataChat = Mail::where('chat_id', $chatId)->get();
        if (Auth::user()->is_admin){
            return view('dashboard.mail.mailAdmin', [
                'Mail' => $dataChat,
            ]);
        } else {
            return view('dashboard.mail.mailUser', [
                'Mail' => $dataChat,
                // 'User' => User::where('id', $dataChat[0]->user_id)
            ]);
        }
    }

    public function detail($chatId)
    {

        if (Auth::user()->is_admin) {
            return view('dashboard.mail.mailAdmin', [
                'Mail' => Mail::where('chat_id', $chatId)->get(),
            ]);
        } else {
            return view('dashboard.mail.mailUser', [
                'Mail' => Mail::where('chat_id', $chatId)->get(),
            ]);
        }
    }


    public function sendMail()
    {
        $chatId = request('chatId');
        $receiverId = request('receiverId');
        $senderId = request('senderId');
        $message = request('message');

        $senderName = User::where('id', $senderId)->get();
        $receiverName = User::where('id', $receiverId)->get();

        $dataToMails = [
            'chat_id' => $chatId,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'pengirim' => $senderName[0]->name,
            'penerima' => $receiverName[0]->name,
            'message' => $message
        ];

        $rulesMails = [
            'chat_id' => 'required|integer',
            'sender_id' => 'required|integer',
            'receiver_id' => 'required|integer',
            'pengirim' => 'required|max:255|string',
            'penerima' => 'required|max:255|string',
            'message' => 'required|max:1000|string',
        ];

        $validatorMails = Validator::make($dataToMails, $rulesMails);

        if ($validatorMails->fails()) {
            echo "validatorChatMails Error ";
        }

        Mail::create($dataToMails);

        return redirect('/dashboard/mail/detail/' . $chatId)->with('success', 'Mail terkirim!');
    }

    public function createMail()
    {
        return view('dashboard.mail.create', [
            'users' => User::all(),
        ]);
    }

    public function destroy()
    {
        $mailId = $_POST['id'];
        $chatId = $_POST['chatId'];
        if (Auth::user()->is_admin) {
            Mail::destroy($mailId);
            return redirect('/dashboard/mail/detail/'.$chatId)->with('succes', 'Mail berhasil dihapus!');
        } else {
            Mail::destroy($mailId);
            return redirect('/dashboard/mail/detail/'.$chatId)->with('succes', 'Mail berhasil dihapus!');
        }
    }
}
