<?php


namespace App\Repositories;


use App\Album;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AlbumRepository implements AlbumRepositoryInterface
{
    /**
     * @var Album
     */
    protected $album;

    /**
     * AlbumRepository constructor.
     * @param Album $album
     */
    public function __construct(Album $album)
    {
        $this->album = $album;
    }

    /**
     * @return Album[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->album->all();
    }

    /**
     * @param array $data
     * @return Album
     */
    public function create(array $data)
    {
        return $this->album->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return Album
     */
    public function update(array $data, $id)
    {
        $album = $this->find($id);
        $album->update($data);
        return $album;
    }

    /**
     * @param $id
     * @return boolean
     */
    public function delete($id)
    {
        $album = $this->find($id);
        return $album->destroy($id);
    }

    /**
     * @param $id
     * @return Album|ModelNotFoundException
     */
    public function find($id)
    {
        $album = $this->album->find($id);
        if (!$album) {
            throw new ModelNotFoundException('Album not found.');
        }
        return $album;
    }
}