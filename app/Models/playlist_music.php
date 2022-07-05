<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class playlist_music extends Model
{
    protected $table = 'musician';
    protected $fillable = ['playlist_id', 'music_id'];
    use HasFactory;
}
