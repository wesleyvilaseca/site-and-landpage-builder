<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebSiteStoreUpdate extends FormRequest
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
            'title' => ["required", "max:200"],
            'site_url' => ["required", "max:500", "unique:web_sites,site_url,{$this->id}"],
            'status' => ["required", "integer"],
            'https' => ["required", "integer"],
        ];
    }
}
