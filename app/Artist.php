<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'image_url', 'created_at', 'updated'];


    public function albums()
    {
        return $this->hasMany(Album::class, 'artist_id', 'id');
    }
}
