<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            'title' => 'required|max:255',
            'overview_short' => 'required|max:300',
            'overview' => 'required|max:5000',
            'price' => 'required|numeric',
            'uploads' => [
                'required',
                Rule::exists('uploads', 'file_id')->where(function ($query) {
                    $query->whereNull('deleted_at');
                })
            ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'uploads.exists' => 'Пожалуйста, загрузите хотя бы 1 файл.'
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        $this->merge(['uploads' => $this->file->id]);

        return $this->all();
    }
}
