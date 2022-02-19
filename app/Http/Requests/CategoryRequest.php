<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $id=$this->route('id');
        return [
            // "name"=>"required|string|max:255|unique:categories,name,".$id,
            "name"=>[
                'required',
                'string',
                'max:255',
                Rule::unique('categories','name')->ignore($id,'id'),
                // (new Unique('categories','name'))->ignore($id),
            ],
            "Category_Parent"=>"nullable|int|exists:categories,id",
            "description"=>"nullable|string|min:5",
            "image"=>"nullable|image|mimes:png,jpg|max:500"
        ];
    }
    public function messages(){
        
        return 
            [
                'name.required'=>'تأكد من تعبئة حقل الاسم'
            ];
    }
}
