<?php

namespace OpenCompany\Integrations\DeepL;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * DeepL API service client.
 *
 * Handles authentication, request formatting, and error handling for the
 * DeepL translation API. Supports both free and pro accounts via the
 * is_free configuration toggle (controls base URL selection).
 */
class DeepLService
{
    /**
     * Create a new DeepLService instance.
     *
     * @param  string  $authKey  DeepL authentication key.
     * @param  bool  $isFree  Whether to use the free API endpoint.
     */
    public function __construct(
        private string $authKey = '',
        private bool $isFree = false,
    ) {}

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->authKey);
    }

    /**
     * Get the base URL for the configured account type.
     */
    public function getBaseUrl(): string
    {
        return $this->isFree
            ? 'https://api-free.deepl.com/v2'
            : 'https://api.deepl.com/v2';
    }

    /**
     * Translate a single text string.
     *
     * @param  string  $text  The text to translate.
     * @param  string  $targetLang  Target language code (e.g., "DE", "EN-US").
     * @param  string|null  $sourceLang  Source language code, or null for auto-detection.
     * @param  string|null  $formality  Formality preference: "default", "more", "less", or null.
     * @return array<string, mixed> The translation response.
     */
    public function translate(string $text, string $targetLang, ?string $sourceLang = null, ?string $formality = null): array
    {
        $data = [
            'text' => [$text],
            'target_lang' => $targetLang,
        ];

        if ($sourceLang !== null) {
            $data['source_lang'] = $sourceLang;
        }

        if ($formality !== null) {
            $data['formality'] = $formality;
        }

        return $this->request('POST', '/translate', $data);
    }

    /**
     * Translate multiple text strings in a single request.
     *
     * @param  array<string>  $texts  Array of texts to translate.
     * @param  string  $targetLang  Target language code.
     * @param  string|null  $sourceLang  Source language code, or null for auto-detection.
     * @param  string|null  $formality  Formality preference, or null.
     * @return array<string, mixed> The batch translation response.
     */
    public function batchTranslate(array $texts, string $targetLang, ?string $sourceLang = null, ?string $formality = null): array
    {
        $data = [
            'text' => $texts,
            'target_lang' => $targetLang,
        ];

        if ($sourceLang !== null) {
            $data['source_lang'] = $sourceLang;
        }

        if ($formality !== null) {
            $data['formality'] = $formality;
        }

        return $this->request('POST', '/translate', $data);
    }

    /**
     * Detect the language of the given text.
     *
     * @param  string  $text  The text to detect the language of.
     * @return array<string, mixed> The detection response with language_code and confidence.
     */
    public function detectLanguage(string $text): array
    {
        return $this->request('POST', '/detect-language', [
            'text' => $text,
        ]);
    }

    /**
     * Get current API usage information.
     *
     * Returns character count used and character limit for the billing period.
     *
     * @return array<string, mixed> Usage data with character_count, character_limit, etc.
     */
    public function getUsage(): array
    {
        return $this->request('GET', '/usage');
    }

    /**
     * List supported languages.
     *
     * @param  string|null  $type  Filter by type: "source" or "target", or null for all.
     * @return array<string, mixed> List of supported languages.
     */
    public function listLanguages(?string $type = null): array
    {
        $params = [];
        if ($type !== null) {
            $params['type'] = $type;
        }

        return $this->request('GET', '/languages', $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API endpoint path (e.g., "/translate").
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the DeepL API.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->authKey) {
            throw new \RuntimeException('DeepL auth key is not configured.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'DeepL-Auth-Key ' . $this->authKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();
                Log::error("DeepL API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("DeepL API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("DeepL API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to DeepL API: {$e->getMessage()}");
        }
    }
}
