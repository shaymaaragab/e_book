<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class storeSectionRequest extends Request
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
            //
            'section_name'=>'requried|unique:section,section_name|max:30','image_name'=>'mimes:png|max:1024'
        ];
    }
}
