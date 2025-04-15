<?php
namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\Request; 
class TranslationController
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function translate(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'language' => 'required|string',
        ]);

        $text = $request->input('text');
        $targetLanguage = $request->input('language');

        try {
            $result = $this->openAIService->translate('Hello, how are you?', 'english');
            return response()->json($result[0]['content']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Translation failed: '.$e->getMessage()], 500);
        }
    }
}
