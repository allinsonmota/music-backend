<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'description', 'release_date', 'year', 'image_url', 'artist_id'
        ,'created_at', 'updated_at'
    ];

    protected $dates = [
        'release_date'
    ];

    public function songs()
    {
        return $this->hasMany(Song::class, 'album_id', 'id');
    }
}
