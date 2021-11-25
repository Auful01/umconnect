<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProdukRequest extends FormRequest
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
        $produk = $this->route('produk-public');
        return auth()->user()->id == $produk->id_user;
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
            'harga',
            'nama_produk',
            'deskripsi'
        ];
    }
}
