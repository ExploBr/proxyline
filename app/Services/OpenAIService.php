<?php
 
namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;
    protected $apiKey;


    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('OPENAI_API_KEY');  
    }

    public function translate($text, $targetLanguage)
    {
        $response = $this->client->post('https://api.air.fail/public/text/chatgpt', [
            'headers' => [
                'Authorization' =>  'sk-9RWsDbrmYEsUfaHjHk-8o9AUUFtql',
                'Content-Type' => 'application/json',
            ],
            'json' => [
                    
                        'content' => "Перевести текст на {$targetLanguage}: {$text}"
                
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
