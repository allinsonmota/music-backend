<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Http\Requests\AlbumRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Repositories\AlbumRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AlbumController extends Controller
{
    /**
     * @var AlbumRepositoryInterface
     */
    private $albumRepository;

    /**
     * AlbumController constructor.
     * @param AlbumRepositoryInterface $albumRepository
     */
    public function __construct(AlbumRepositoryInterface $albumRepository)
    {
        $this->albumRepository =  $albumRepository;
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
                'data' => $this->albumRepository->all()
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
     * @param  AlbumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        try {
            $data = $request->only([
                'title',
                'description',
                'release_date',
                'year',
                'artist_id',
            ]);
            $album = $this->albumRepository->create($data);
            return response()->json([
                'message' => 'Album created successfully.',
                'data' => $album
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
            return $this->albumRepository->find($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'errors' => [
                    'Album Not found.'
                ],
                'message' => 'Album Not found.'
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
     * @param  AlbumRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $request, $id)
    {
        try {
            $data = $request->only([
                'title',
                'description',
                'release_date',
                'year',
                'artist_id',
            ]);
            $album = $this->albumRepository->update($data, $id);
            return response()->json([
                'message' => 'Album updated successfully.',
                'data' => $album
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'errors' => [
                    'Album Not found.'
                ],
                'message' => 'Album Not found.'
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
            $this->albumRepository->delete($id);
            return response()->json([
                'message' => 'Album deleted successfully.',
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'errors' => [
                    'Album Not found.'
                ],
                'message' => 'Album Not found.'
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
