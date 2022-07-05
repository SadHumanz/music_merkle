<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class likes extends Model
{
    protected $table = 'likes';
    protected $fillable = ['reference_id', 'table_reference', 'users_id'];
    use HasFactory;
}
