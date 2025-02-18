<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAITranslationService
{
    protected $apiKey;
    protected $organization;
    protected $baseUrl = 'https://api.openai.com/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->organization = config('services.openai.organization');
    }

    public function translate(string $text, string $from = 'es', string $to = 'en'): string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'OpenAI-Organization' => $this->organization,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl, [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "You are a professional translator. Translate the following text from $from to $to. Maintain the same tone and style. Only return the translated text, nothing else."
                    ],
                    [
                        'role' => 'user',
                        'content' => $text
                    ]
                ],
                'temperature' => 0.3
            ]);

            if ($response->successful()) {
                return $response->json('choices.0.message.content');
            }

            Log::error('OpenAI Translation Error', [
                'error' => $response->json(),
                'text' => $text
            ]);

            return '';
        } catch (\Exception $e) {
            Log::error('OpenAI Translation Exception', [
                'error' => $e->getMessage(),
                'text' => $text
            ]);

            return '';
        }
    }
}
