<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ussers extends Model
{   
    public $table = 'ussers';
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'age', 'nickname'];

    // Define any relationships if needed
    // Example: a User has many Posts
    
}
