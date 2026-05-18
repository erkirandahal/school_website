<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class DocumentTypeRequest extends FormRequest
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
       $errors = [];
       $errors['title'] = 'required|max:255';
        $errors['title_ne'] = 'required|max:255';
       $errors['image'] = 'sometimes|image|mimes:jpg,png,jpeg,gif|max:5120';
       $errors['order'] = 'required';
       $errors['status'] = 'required';
       return $errors;
   }
}
