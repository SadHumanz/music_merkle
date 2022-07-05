<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class playlist extends Model
{
    protected $table = 'musician';
    protected $fillable = ['title', 'users_id'];
    use HasFactory;
}
