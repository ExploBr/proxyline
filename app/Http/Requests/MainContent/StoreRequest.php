<?php

namespace App\Http\Requests\MainContent;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id"=>"",        
            "name"=> "",
            'lang' => "",
            "adv_images" =>"",
            "adv_imageshas" =>"",
            "adv_content"=> "",
            "adv_sort" =>"",
            'whereuse_image' =>"",
            'whereuse_content' => "",
            'whereuse_imageshas' => "",
            "seoblock_content" => "",
            "affilateblock_content" => "",
            "calculatorblock_content" => "",
             
        ];
    }
}
