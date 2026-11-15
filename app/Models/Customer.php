<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Connect the model to the customers table
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'address',
        'phoneNumber',
        'gender',
        'birthday'
    ];
}
