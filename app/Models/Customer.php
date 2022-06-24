<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'customer_type_id', 'name', 'lastname', 'email', 'phone', 'password', 'status'];

    public function customer_type()
    {
        return $this->hasOne(CustomerType::class, 'id', 'customer_type_id');
    }
}
