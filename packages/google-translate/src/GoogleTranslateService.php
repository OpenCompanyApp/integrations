<?php

namespace OpenCompany\Integrations\GoogleTranslate;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleTranslateService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://translation.googleapis.com/language/translate/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Translate text using the Google Cloud Translation API.
     *
     * @param  string|array<string>  $text  One or more texts to translate.
     * @param  string  $targetLang  The target language code (e.g., "en", "de", "fr").
     * @param  string|null  $sourceLang  The source language code. Auto-detected if null.
     * @param  string|null  $format  Text format: "text" or "html". Defaults to "text".
     * @return array<string, mixed> The API response containing translations.
     */
    public function translateText(string|array $text, string $targetLang, ?string $sourceLang = null, ?string $format = null): array
    {
        $data = [
            'q' => is_array($text) ? $text : [$text],
            'target' => $targetLang,
        ];

        if ($sourceLang !== null) {
            $data['source'] = $sourceLang;
        }

        if ($format !== null) {
            $data['format'] = $format;
        }

        return $this->request('POST', '', $data);
    }

    /**
     * Detect the language of the given text.
     *
     * @param  string|array<string>  $text  One or more texts to detect.
     * @return array<string, mixed> The API response containing detected languages.
     */
    public function detectLanguage(string|array $text): array
    {
        $data = [
            'q' => is_array($text) ? $text : [$text],
        ];

        return $this->request('POST', '/detect', $data);
    }

    /**
     * List supported languages.
     *
     * @param  string|null  $target  Target language code for localizing language names.
     * @return array<string, mixed> The API response containing language list.
     */
    public function listSupportedLanguages(?string $target = null): array
    {
        $params = [];
        if ($target !== null) {
            $params['target'] = $target;
        }

        return $this->request('GET', '/languages', $params);
    }

    /**
     * List all glossaries in the project.
     *
     * @return array<string, mixed> The API response containing glossary list.
     */
    public function listGlossaries(): array
    {
        return $this->request('GET', '/glossary', []);
    }

    /**
     * Get details of a specific glossary.
     *
     * @param  string  $name  The glossary resource name (e.g., "projects/PROJECT_ID/locations/LOCATION/glossaries/GLOSSARY_ID").
     * @return array<string, mixed> The API response containing glossary details.
     */
    public function getGlossary(string $name): array
    {
        return $this->request('GET', '/glossary/' . urlencode($name), []);
    }

    /**
     * Create a new glossary.
     *
     * @param  string  $name  The glossary resource name.
     * @param  string  $sourceLang  The source language code.
     * @param  string  $targetLang  The target language code.
     * @param  array  $entries  Array of term pairs: [["source" => "text", "target" => "text"], ...].
     * @return array<string, mixed> The API response containing the created glossary (or operation).
     */
    public function createGlossary(string $name, string $sourceLang, string $targetLang, array $entries): array
    {
        $data = [
            'name' => $name,
            'languagePair' => [
                'sourceLanguageCode' => $sourceLang,
                'targetLanguageCode' => $targetLang,
            ],
            'entries' => [
                'termPairs' => $entries,
            ],
        ];

        return $this->request('POST', '/glossary', $data);
    }

    /**
     * Get information about the current user / API key.
     *
     * Uses a simple translate call with a minimal payload to verify the API key is valid.
     *
     * @return array<string, mixed> The API response.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '', []);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (appended to base URL).
     * @param  array<string, mixed>  $data  Request data.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Google Cloud Translation API.
     *
     * The API key is passed as a query parameter `key`.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Google Translate API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30);

            // Google Cloud Translation API uses the key as a query parameter
            $data['key'] = $this->apiKey;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Google Translate API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Google Translate API endpoint not available (HTTP {$response->status()}). Check the base URL configuration.");
                }

                $error = $response->json('error.message') ?? $response->json('message') ?? $response->body();
                Log::error("Google Translate API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Google Translate API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Translate API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Google Translate API: {$e->getMessage()}");
        }
    }
}
