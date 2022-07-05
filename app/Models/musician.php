<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class musician extends Model
{
    protected $table = 'musician';
    protected $fillable = ['nama'];
    use HasFactory;
}
