<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSite extends Model
{
    use HasFactory;

    protected $table = 'web_sites';
    protected $fillable = ['user_id', 'title', 'site_url'];
}
