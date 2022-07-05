<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class music extends Model
{
    protected $table = 'music';
    protected $fillable = ['title', 'duration', 'mma_tbl_musiccol', 'album_id'];
    use HasFactory;
}
