<?php

namespace App\Http\Requests;

class UpdateFileRequest extends StoreFileRequest
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
        return array_merge(parent::rules(), ['live' => '']);
    }

    /**
     * @return array
     */
    public function messages()
    {
        return parent::messages();
    }
}
