<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    // use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['pengirim'];

    // Attribut yang dapat diisi secara massal
    protected $fillable = ['chat_id', 'sender_id', 'receiver_id', 'pengirim', 'penerima', 'message'];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}