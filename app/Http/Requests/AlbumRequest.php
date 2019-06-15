<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:5',
            'description' => 'max:225',
            'release_date' => 'required|date',
            'year' => 'required|numeric',
            'artist_id' => 'required|exists:artists,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required.',
            'title.max' => "Title can't be more than 50 length.",
            'description.max' => "Description can't be more than 225 length.",
            'release_date.required' => "Release date is required.",
            'release_date.date' => "Release date must be in Y-m-d format.",
            'year.required' => "Year is required.",
            'year.numeric' => "Year must greater than 0.",
            'artist_id.required' => "Artist is required.",
            'artist_id.exists' => "Artist not found.",
        ];
    }
}
