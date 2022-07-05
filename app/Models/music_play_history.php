<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class music_play_history extends Model
{
    protected $table = 'likes';
    protected $fillable = ['music_id', 'users_id'];
    use HasFactory;
}
