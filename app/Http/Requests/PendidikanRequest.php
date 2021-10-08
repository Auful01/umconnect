<?php

namespace App\Http\Requests;

use App\Models\Kiriman;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class PendidikanRequest extends FormRequest
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
        $kiriman = $this->route('kiriman');
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
            'instansi',
            'jenjang',
            'fakultas',
            'jurusan',
            'tahun_masuk',
            'tahun_keluar'
        ];
    }
}
