<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    // use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = ['chat_id', 'user_id', 'sender_id', 'receiver_id', 'name', 'message'];
}
