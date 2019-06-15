<?php

use Illuminate\Database\Seeder;
use App\Artist;
use App\Album;
use App\Song;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Artist::class, 7)->create()->each(function ($artist) {
            $artist->albums()->saveMany(factory(Album::class, 3)->create()->each(function ($album) use ($artist) {
                $album->songs()->saveMany(factory(Song::class,5)
                    ->create()
                    ->each(function ($song) use ($album, $artist)  {
                        $song->album_id = $album->id;
                        $song->artist_id = $artist->id;
                    })
                );
            }));
        });
    }
}
