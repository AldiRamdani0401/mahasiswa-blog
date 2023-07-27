<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\User;
use App\Models\ChatRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;

        return view('dashboard.mail.index', [
            'mails' => Mail::where('receiver_id', $user)->get(),
            'chatId' => ChatRoom::where('user_id', $user)->get()
        ]);
    }

    public function openMail($chatId)
    {
        $chatId = request('chatId');

        $dataChat = ChatRoom::where('chat_id', $chatId)->get();
        if (Auth::user()->is_admin){
            return view('dashboard.mail.mailAdmin', [
                'penerima' => Mail::where('contact_id', Auth::user()->id)->get(),
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
                'pengirim' => $chatId,
            ]);
        } else {
            return view('dashboard.mail.mailUser', [
                'Mail' => ChatRoom::where('chat_id', $chatId)->get(),
            ]);
        }
    }


    public function sendMail()
    {
        $chatId = request('chatId');
        $receiverId = request('receiverId');
        $senderId = request('senderId');
        $message = request('message');

        $dataToMails = [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
        ];

        $name = User::where('id', $senderId)->get();

        $dataToChatRooms = [
            'chat_id' => $chatId,
            'user_id' => $senderId,
            'message' => $message,
            'name'    => $name[0]->name,
        ];

        $rulesMails = [
            'sender_id' => 'required|integer',
            'receiver_id' => 'required|integer',
        ];

        $rulesChatRooms = [
            'chat_id' => 'required|integer',
            'message' => 'required|max:1000|string',
            'user_id' => 'required|integer',
            'name' => 'required|max:225|string',
        ];

        $validatorMails = Validator::make($dataToMails, $rulesMails);
        $validatorChatRooms = Validator::make($dataToChatRooms, $rulesChatRooms);

        // Memeriksa apakah validasi berhasil
        if ($validatorMails->fails()) {
            echo "validatorChatMails Error ";
        }

        if ($validatorChatRooms->fails()) {
            echo "validatorChatRooms Error ";
        }

        Mail::create($dataToMails);
        ChatRoom::create($dataToChatRooms);

        return redirect('/dashboard/mail/detail/' . $chatId)->with('success', 'Mail terkirim!');
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
