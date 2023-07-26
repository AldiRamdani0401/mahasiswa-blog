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
    protected $fillable = ['status', 'user_id', 'pesan', 'contact_id', 'recipient_id'];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}