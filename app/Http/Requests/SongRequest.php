<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongRequest extends FormRequest
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
            'title' => 'required|max:40',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'required|exists:albums,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required.',
            'title.max' => "Title can't be more than 40 length.",
            'artist_id.required' => "Artist is required.",
            'artist_id.exists' => "Artist not found.",
            'album_id.required' => "Album is required.",
            'album_id.exists' => "Album not found.",
        ];
    }
}
