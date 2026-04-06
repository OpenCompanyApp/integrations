<?php

namespace OpenCompany\Integrations\DeepL;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DeepLService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.deepl.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Translate text using the DeepL API.
     *
     * @param  string|array<string>  $text  One or more texts to translate.
     * @param  string  $targetLang  The target language code (e.g., "EN", "DE", "FR").
     * @param  string|null  $sourceLang  The source language code (e.g., "EN", "DE"). Auto-detected if null.
     * @return array<string, mixed> The API response containing translations.
     */
    public function translateText(string|array $text, string $targetLang, ?string $sourceLang = null): array
    {
        $data = [
            'text' => is_array($text) ? $text : [$text],
            'target_lang' => $targetLang,
        ];

        if ($sourceLang !== null) {
            $data['source_lang'] = $sourceLang;
        }

        return $this->request('POST', '/v2/translate', $data);
    }

    /**
     * List supported languages.
     *
     * @param  string|null  $type  "source" for source languages, "target" for target languages. Returns all if null.
     * @return array<string, mixed> The API response containing language list.
     */
    public function listLanguages(?string $type = null): array
    {
        $params = [];
        if ($type !== null) {
            $params['type'] = $type;
        }

        return $this->request('GET', '/v2/languages', $params);
    }

    /**
     * Get current DeepL API usage information.
     *
     * @return array<string, mixed> The API response containing usage stats.
     */
    public function getUsage(): array
    {
        return $this->request('GET', '/v2/usage');
    }

    /**
     * List all glossaries.
     *
     * @return array<string, mixed> The API response containing glossary list.
     */
    public function listGlossaries(): array
    {
        return $this->request('GET', '/v2/glossaries');
    }

    /**
     * Get details of a specific glossary.
     *
     * @param  string  $id  The glossary ID.
     * @return array<string, mixed> The API response containing glossary details.
     */
    public function getGlossary(string $id): array
    {
        return $this->request('GET', '/v2/glossaries/' . urlencode($id));
    }

    /**
     * Create a new glossary.
     *
     * @param  string  $name  The glossary name.
     * @param  string  $sourceLang  The source language code.
     * @param  string  $targetLang  The target language code.
     * @param  string  $entries  Tab-separated entries (source\ttarget), one per line.
     * @return array<string, mixed> The API response containing the created glossary.
     */
    public function createGlossary(string $name, string $sourceLang, string $targetLang, string $entries): array
    {
        return $this->request('POST', '/v2/glossaries', [
            'name' => $name,
            'source_lang' => $sourceLang,
            'target_lang' => $targetLang,
            'entries' => $entries,
            'entries_format' => 'tsv',
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST/PUT).
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the DeepL API.
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
            throw new \RuntimeException('DeepL API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'DeepL-Auth-Key ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

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
                    Log::warning("DeepL API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("DeepL API endpoint not available (HTTP {$response->status()}). Check the base URL configuration.");
                }

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
