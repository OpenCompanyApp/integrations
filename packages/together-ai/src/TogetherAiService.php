<?php

namespace OpenCompany\Integrations\TogetherAi;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TogetherAiService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.together.xyz/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List available models.
     *
     * @return array<string, mixed>
     */
    public function listModels(): array
    {
        return $this->request('GET', '/models');
    }

    /**
     * Create a chat completion.
     *
     * @param  array<string, mixed>  $body  Request body (model, messages, etc.)
     * @return array<string, mixed>
     */
    public function createCompletion(array $body): array
    {
        return $this->request('POST', '/chat/completions', $body);
    }

    /**
     * List fine-tuning jobs.
     *
     * @return array<string, mixed>
     */
    public function listFineTunes(): array
    {
        return $this->request('GET', '/fine-tunes');
    }

    /**
     * Get details of a specific fine-tuning job.
     *
     * @param  string  $fineTuneId  The fine-tune job ID
     * @return array<string, mixed>
     */
    public function getFineTune(string $fineTuneId): array
    {
        return $this->request('GET', '/fine-tunes/' . $fineTuneId);
    }

    /**
     * List files uploaded to Together AI.
     *
     * @return array<string, mixed>
     */
    public function listFiles(): array
    {
        return $this->request('GET', '/files');
    }

    /**
     * Get details of a specific file.
     *
     * @param  string  $fileId  The file ID
     * @return array<string, mixed>
     */
    public function getFile(string $fileId): array
    {
        return $this->request('GET', '/files/' . $fileId);
    }

    /**
     * Get the currently authenticated user's information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user/info');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path (e.g. "/models")
     * @param  array<string, mixed>  $data  Query parameters or request body
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Together AI API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path
     * @param  array<string, mixed>  $data  Query parameters (GET) or request body (POST)
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Together AI API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(120);

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
                    Log::warning("Together AI API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Together AI API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Together AI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Together AI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Together AI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Together AI API: {$e->getMessage()}");
        }
    }
}
