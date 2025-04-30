<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
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
             
             
            "tarif" => "",
            "ip_type"=> "",
            "ip_version"=>"",
            "country"=>"",
            "country_name"=>"",
            "country_flag"=>"",
            "quantity"=>"",
            "period"=>"",
            "price"=>"",
            "price_rub"=>"",
            "usd_curse"=>"",
            "total_rub"=>"",
            "summ"=>"",
            "total"=>"",
            "ip_list"=>"",
            "ip_list_name"=>"",
            
        ];
    }
}
