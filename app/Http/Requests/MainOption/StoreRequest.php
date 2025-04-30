<?php

namespace App\Http\Requests\MainOption;

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
            "logo_image" =>"",
            "methods_image" =>"",
            "reviews_ru_images" => "",
            "reviews_en_images" => "",
            "reviews_ru_sort" => "",
            "reviews_en_sort" => "",
            "reviews_ru_imageshas"=>"",
            "reviews_en_imageshas"=>"",
            "reviews_ru_content"=>"",
            "reviews_en_content"=>"",
            "reviews_ru_name"=>"",
            "reviews_en_name"=>"",
            "menu_top_name" => "",
            "menu_top_slug" => "",
            "menu_info_name" => "",
            "menu_info_slug" => "",
            "menu_main_bottom_name" => "",
            "menu_main_bottom_slug" => "",
            "socials_name" => "",
            "socials_link" => "",
            "socials_podpis" => "",
            "socials_image" => "",
            "socials_imageName" => "",
            "socials_imagePath" => "",
            "socials_imageUrl" => "",
            "socials_imageSize" => "",

        ];
    }
}
