<?php

namespace OpenCompany\Integrations\EdenAi;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EdenAiService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.edenai.run/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Generate text using AI providers.
     *
     * @param  array  $body  Request body containing providers, text, and optional parameters.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function generateText(array $body): array
    {
        return $this->request('POST', '/text/generation', $body);
    }

    /**
     * Analyze an image using AI providers.
     *
     * @param  array  $body  Request body containing providers, image URL or base64, and features.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function analyzeImage(array $body): array
    {
        return $this->request('POST', '/image/analyze', $body);
    }

    /**
     * Translate text using AI providers.
     *
     * @param  array  $body  Request body containing providers, source_language, target_language, and text.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function translateText(array $body): array
    {
        return $this->request('POST', '/translation/translate', $body);
    }

    /**
     * Transcribe audio using AI providers.
     *
     * @param  array  $body  Request body containing providers and audio URL or base64.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function transcribeAudio(array $body): array
    {
        return $this->request('POST', '/audio/transcription', $body);
    }

    /**
     * Perform OCR (Optical Character Recognition) asynchronously.
     *
     * @param  array  $body  Request body containing providers and document URL or base64.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function ocr(array $body): array
    {
        return $this->request('POST', '/ocr/async', $body);
    }

    /**
     * Get the current authenticated user's information.
     *
     * @return array<string, mixed> Parsed JSON response.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST).
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Eden AI API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request payload or query parameters.
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Eden AI API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(60);

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
                    Log::warning("Eden AI API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Eden AI API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Eden AI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Eden AI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Eden AI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Eden AI API: {$e->getMessage()}");
        }
    }
}
