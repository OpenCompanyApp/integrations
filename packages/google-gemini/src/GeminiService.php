<?php

namespace OpenCompany\Integrations\GoogleGemini;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://generativelanguage.googleapis.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List available models.
     *
     * @param  int  $pageSize  Maximum number of models to return per page.
     * @param  string|null  $pageToken  Token for requesting the next page of results.
     * @return array<string, mixed>
     */
    public function listModels(int $pageSize = 50, ?string $pageToken = null): array
    {
        $params = ['pageSize' => $pageSize];
        if ($pageToken) {
            $params['pageToken'] = $pageToken;
        }

        return $this->request('GET', '/v1/models', $params);
    }

    /**
     * Get details for a specific model.
     *
     * @param  string  $id  The model identifier (e.g., "models/gemini-pro").
     * @return array<string, mixed>
     */
    public function getModel(string $id): array
    {
        return $this->request('GET', '/v1/' . $id);
    }

    /**
     * Generate content using a model.
     *
     * @param  string  $id  The model identifier (e.g., "models/gemini-pro").
     * @param  array  $contents  The content messages to send.
     * @param  array  $generationConfig  Generation parameters (temperature, topP, maxOutputTokens).
     * @return array<string, mixed>
     */
    public function generateContent(string $id, array $contents, array $generationConfig = []): array
    {
        $body = [
            'contents' => $contents,
        ];

        if (!empty($generationConfig)) {
            $body['generationConfig'] = $generationConfig;
        }

        return $this->request('POST', '/v1/' . $id . ':generateContent', $body);
    }

    /**
     * List uploaded files.
     *
     * @param  int  $pageSize  Maximum number of files to return per page.
     * @param  string|null  $pageToken  Token for requesting the next page of results.
     * @return array<string, mixed>
     */
    public function listFiles(int $pageSize = 50, ?string $pageToken = null): array
    {
        $params = ['pageSize' => $pageSize];
        if ($pageToken) {
            $params['pageToken'] = $pageToken;
        }

        return $this->request('GET', '/v1/files', $params);
    }

    /**
     * Get details for a specific file.
     *
     * @param  string  $id  The file identifier (e.g., "files/abc123").
     * @return array<string, mixed>
     */
    public function getFile(string $id): array
    {
        return $this->request('GET', '/v1/' . $id);
    }

    /**
     * List tuned models.
     *
     * @param  int  $pageSize  Maximum number of tuned models to return per page.
     * @param  string|null  $pageToken  Token for requesting the next page of results.
     * @return array<string, mixed>
     */
    public function listTunedModels(int $pageSize = 50, ?string $pageToken = null): array
    {
        $params = ['pageSize' => $pageSize];
        if ($pageToken) {
            $params['pageToken'] = $pageToken;
        }

        return $this->request('GET', '/v1/tunedModels', $params);
    }

    /**
     * Get the current authenticated user's information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/v1/models").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Gemini API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Google Gemini API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'x-goog-api-key' => $this->apiKey,
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
                $error = $response->json('error.message') ?? $response->body();
                Log::error("Gemini API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Gemini API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Gemini API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Gemini API: {$e->getMessage()}");
        }
    }
}
