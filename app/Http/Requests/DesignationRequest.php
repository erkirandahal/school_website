<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesignationRequest extends FormRequest
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
        $rules = [];

        if ($this->method() == 'POST') {

            $rules['name'] = 'required|max:255|unique:designations,name';

            $rules['name_np'] = 'required|max:255|unique:designations,name_np';

        } else {

            $rules['name'] = 'required|max:255|unique:designations,name,' . $this->designation;

            $rules['name_np'] = 'required|max:255|unique:designations,name_np,' . $this->designation;
        }

        $rules['order'] = 'required|numeric';

        return $rules;
    }
}
