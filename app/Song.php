<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'url', 'artist_id', 'album_id', 'created_at', 'updated_at'];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }
}
