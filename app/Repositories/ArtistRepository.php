<?php


namespace App\Repositories;


use App\Artist;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArtistRepository implements ArtistRepositoryInterface
{
    /**
     * @var Artist
     */
    protected $artist;

    /**
     * ArtistRepository constructor.
     * @param Artist $artist
     */
    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    /**
     * @return Artist[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->artist->all();
    }

    /**
     * @param array $data
     * @return Artist
     */
    public function create(array $data)
    {
        return $this->artist->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return Artist
     */
    public function update(array $data, $id)
    {
        $artist = $this->find($id);
        $artist->update($data);
        return $artist;
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $artist = $this->find($id);
        return $artist->destroy($id);
    }

    /**
     * @param $id
     * @return Artist|ModelNotFoundException
     */
    public function find($id)
    {
        $artist = $this->artist->find($id);
        if (!$artist) {
            throw new ModelNotFoundException("Artist Not Fond");
        }
        return $artist;
    }
}