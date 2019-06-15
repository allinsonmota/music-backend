<?php


namespace App\Repositories;


use App\Song;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SongRepository implements SongRepositoryInterface
{
    /**
     * @var Song
     */
    protected $song;

    /**
     * SongRepository constructor.
     * @param Song $song
     */
    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    /**
     * @return Song[]|Collection
     */
    public function all()
    {
        return $this->song->all();
    }

    /**
     * @param array $data
     * @return Song
     */
    public function create(array $data)
    {
        return $this->song->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return Song
     */
    public function update(array $data, $id)
    {
        $song = $this->find($id);
        $song->update($data);
        return $song;
    }

    /**
     * @param $id
     * @return boolean
     */
    public function delete($id)
    {
        $song = $this->find($id);
        return $song->destroy($id);
    }

    /**
     * @param $id
     * @return Song|ModelNotFoundException
     */
    public function find($id)
    {
        $song = $this->song->find($id);
        if (!$song) {
            throw new ModelNotFoundException("Song Not Fond");
        }
        return $song;
    }
}