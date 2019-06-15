<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ArtistRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\ArtistRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArtistController extends Controller
{
    /**
     * @var ArtistRepositoryInterface
     */
    private $artistRepository;

    public function __construct(ArtistRepositoryInterface $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->artistRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistRequest $request)
    {
        try {
            $data = Input::only('name');
            $artist = $this->artistRepository->create($data);
            return response()->json([
                'message' => 'Artist created successfully.',
                'data' => $artist
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
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
            return $this->artistRepository->find($id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'errors' => [
                    'Artist Not found.'
                ],
                'message' => 'Artist Not found.'
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArtistRequest $request, $id)
    {
        try {
            $data = Input::only(['name']);
            $artist = $this->artistRepository->update($data, $id);
            return response()->json([
                'message' => 'Artist updated successfully.',
                'data' => $artist
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'errors' => [
                    'Artist Not found.'
                ],
                'message' => 'Artist Not found.'
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
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
            $this->artistRepository->delete($id);
            return response()->json([
                'message' => 'Artist deleted successfully.',
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'errors' => [
                    'Artist Not found.'
                ],
                'message' => 'Artist Not found.'
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'Oops something went wrong.'
                ],
                'message' => 'Oops something went wrong.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
