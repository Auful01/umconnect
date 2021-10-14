<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class KirimanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        if ($this->method() == Request::METHOD_POST)
            return true;
        $kiriman = $this->route('api-kiriman');
        // return auth()->user()->id;
        return auth()->user()->id == $kiriman->id_user;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gambar',
            'konten'
        ];
    }
}
