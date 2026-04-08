<?php

namespace OpenCompany\Integrations\Openrouter;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * OpenRouter API service — AI gateway for models, completions, and management.
 *
 * Handles authenticated HTTP requests to the OpenRouter v1 REST API
 * using Bearer token authentication. Supports configurable base URL
 * for custom endpoints or proxies.
 *
 * @see https://openrouter.ai/docs/api-reference
 */
class OpenrouterService
{
    /**
     * Create a new OpenRouter service instance.
     *
     * @param  string  $apiKey  OpenRouter API key for Bearer authentication.
     * @param  string  $baseUrl  Base URL for the OpenRouter API (default: https://openrouter.ai/api/v1).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://openrouter.ai/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List available models on OpenRouter.
     *
     * @return array List of model resources.
     *
     * @see https://openrouter.ai/docs/api-reference/list-models
     */
    public function listModels(): array
    {
        return $this->request('GET', '/models');
    }

    /**
     * Create a chat completion.
     *
     * @param  array  $options  Completion options including 'model', 'messages',
     *                           and optional settings like temperature, max_tokens, etc.
     * @return array The completion response.
     *
     * @see https://openrouter.ai/docs/api-reference/create-completion
     */
    public function createCompletion(array $options): array
    {
        return $this->request('POST', '/chat/completions', $options);
    }

    /**
     * List generation records.
     *
     * @param  array  $params  Query parameters for filtering and pagination.
     * @return array Paginated list of generation resources.
     *
     * @see https://openrouter.ai/docs/api-reference/list-generations
     */
    public function listGenerations(array $params = []): array
    {
        return $this->request('GET', '/generation', $params);
    }

    /**
     * Get details for a specific generation.
     *
     * @param  string  $id  The generation identifier.
     * @return array The generation resource.
     *
     * @see https://openrouter.ai/docs/api-reference/get-generation
     */
    public function getGeneration(string $id): array
    {
        return $this->request('GET', '/generation', ['id' => $id]);
    }

    /**
     * List API keys for the authenticated account.
     *
     * @return array List of API key resources.
     *
     * @see https://openrouter.ai/docs/api-reference/list-api-keys
     */
    public function listApiKeys(): array
    {
        return $this->request('GET', '/keys');
    }

    /**
     * Get usage statistics for the authenticated account.
     *
     * @param  array  $params  Query parameters for filtering (e.g., period).
     * @return array Usage data.
     *
     * @see https://openrouter.ai/docs/api-reference/get-usage
     */
    public function getUsage(array $params = []): array
    {
        return $this->request('GET', '/usage', $params);
    }

    /**
     * Get the current authenticated user's profile.
     *
     * @return array User profile data.
     *
     * @see https://openrouter.ai/docs/api-reference/get-current-user
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/auth/key');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., '/models').
     * @param  array  $data  Query parameters or JSON body.
     * @return array Decoded JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the OpenRouter API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array  $data  Request data (query params for GET, JSON body for POST/PUT/DELETE).
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('OpenRouter API key is not configured.');
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
                    Log::warning("OpenRouter API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("OpenRouter API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error.message') ?? $response->json('error') ?? $body;
                Log::error("OpenRouter API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("OpenRouter API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("OpenRouter API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to OpenRouter API: {$e->getMessage()}");
        }
    }
}
