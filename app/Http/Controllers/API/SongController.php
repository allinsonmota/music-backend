<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\SongRequest;
use App\Repositories\SongRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class SongController extends Controller
{
    /**
     * @var SongRepositoryInterface
     */
    private $songRepository;

    public function __construct(SongRepositoryInterface $songRepository)
    {
        $this->songRepository = $songRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json([
                'data' => $this->songRepository->all()
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'errors' => [
                    'Oops something went wrong.'
                ],
                'message' => 'Oops something went wrong.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SongRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SongRequest $request)
    {
        try {
            $data = $request->only([
                'title',
                'artist_id',
                'album_id',
            ]);
            $song = $this->songRepository->create($data);
            return response()->json([
                'message' => 'Song created successfully.',
                'data' => $song
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'errors' => [
                    'Oops something went wrong.'
                ],
                'message' => 'Oops something went wrong.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return $this->songRepository->find($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'errors' => [
                    'Song Not found.'
                ],
                'message' => 'Song Not found.'
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json([
                'errors' => [
                    'Oops something went wrong.'
                ],
                'message' => 'Oops something went wrong.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SongRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SongRequest $request, $id)
    {
        try {
            $data = $request->only([
                'title',
                'artist_id',
                'album_id',
            ]);
            $song = $this->songRepository->update($data, $id);
            return response()->json([
                'message' => 'Song updated successfully.',
                'data' => $song
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'errors' => [
                    'Song Not found.'
                ],
                'message' => 'Song Not found.'
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json([
                'errors' => [
                    'Oops something went wrong.'
                ],
                'message' => 'Oops something went wrong.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->songRepository->delete($id);
            return response()->json([
                'message' => 'Song deleted successfully.',
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'errors' => [
                    'Song Not found.'
                ],
                'message' => 'Song Not found.'
            ], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            return response()->json([
                'errors' => [
                    'Oops something went wrong.'
                ],
                'message' => 'Oops something went wrong.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
