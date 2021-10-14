<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AgendaRequest extends FormRequest
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
        $agenda = $this->route('agenda');
        return auth()->user()->id == $agenda->id_user;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'id_user' => 'required|integer',
            'title',
            'lokasi',
            'tanggal',
            'waktu',
            'konten',
            'photo',
            'status'
        ];
    }
}
