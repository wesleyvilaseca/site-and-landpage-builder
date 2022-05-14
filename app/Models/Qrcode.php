<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'url', 'qrcode'];
    protected $table = 'qrcodes';
}
