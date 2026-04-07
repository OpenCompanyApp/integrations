<?php

namespace OpenCompany\Integrations\Huggingface;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HuggingfaceService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://huggingface.co/api',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List models from the Hugging Face Hub.
     *
     * @param  array<string, mixed>  $params  Query parameters (search, author, sort, direction, limit, etc.)
     * @return array<string, mixed>
     */
    public function listModels(array $params = []): array
    {
        return $this->request('GET', '/models', $params);
    }

    /**
     * Get detailed information about a specific model.
     *
     * @param  string  $modelId  The model ID (e.g. "meta-llama/Llama-3.3-70B-Instruct")
     * @return array<string, mixed>
     */
    public function getModel(string $modelId): array
    {
        return $this->request('GET', '/models/' . urlencode($modelId));
    }

    /**
     * List datasets from the Hugging Face Hub.
     *
     * @param  array<string, mixed>  $params  Query parameters (search, author, sort, direction, limit, etc.)
     * @return array<string, mixed>
     */
    public function listDatasets(array $params = []): array
    {
        return $this->request('GET', '/datasets', $params);
    }

    /**
     * Get detailed information about a specific dataset.
     *
     * @param  string  $datasetId  The dataset ID (e.g. "mozilla-foundation/common_voice_17_0")
     * @return array<string, mixed>
     */
    public function getDataset(string $datasetId): array
    {
        return $this->request('GET', '/datasets/' . urlencode($datasetId));
    }

    /**
     * List Spaces from the Hugging Face Hub.
     *
     * @param  array<string, mixed>  $params  Query parameters (search, author, sort, direction, limit, etc.)
     * @return array<string, mixed>
     */
    public function listSpaces(array $params = []): array
    {
        return $this->request('GET', '/spaces', $params);
    }

    /**
     * Get detailed information about a specific Space.
     *
     * @param  string  $spaceId  The Space ID (e.g. "stabilityai/stable-diffusion-3.5")
     * @return array<string, mixed>
     */
    public function getSpace(string $spaceId): array
    {
        return $this->request('GET', '/spaces/' . urlencode($spaceId));
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
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
     * Make a raw HTTP request to the Hugging Face API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<string, mixed>  $data  Query parameters (GET) or request body (POST)
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Hugging Face access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                    Log::warning("Hugging Face API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Hugging Face API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Hugging Face API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Hugging Face API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Hugging Face API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Hugging Face API: {$e->getMessage()}");
        }
    }
}
