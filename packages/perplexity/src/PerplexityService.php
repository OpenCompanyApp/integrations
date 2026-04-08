<?php

namespace OpenCompany\Integrations\Perplexity;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PerplexityService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.perplexity.ai',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Send a chat completion request.
     *
     * @param  array  $messages  Array of message objects with 'role' and 'content'.
     * @param  string  $model  Model to use (e.g., "sonar", "sonar-pro").
     * @param  array  $options  Additional options (temperature, max_tokens, etc.).
     * @return array The API response.
     */
    public function chat(array $messages, string $model = 'sonar', array $options = []): array
    {
        $body = array_merge([
            'model' => $model,
            'messages' => $messages,
        ], $options);

        return $this->request('POST', '/chat/completions', $body);
    }

    /**
     * Ask a question and get an answer with citations.
     *
     * @param  string  $query  The question to ask.
     * @param  array  $options  Additional options (model, search_domain_filter, etc.).
     * @return array The API response.
     */
    public function ask(string $query, array $options = []): array
    {
        $body = array_merge([
            'query' => $query,
        ], $options);

        return $this->request('POST', '/ask', $body);
    }

    /**
     * List available models.
     *
     * @return array List of model objects.
     */
    public function listModels(): array
    {
        return $this->request('GET', '/models');
    }

    /**
     * Get the current authenticated user's information.
     *
     * @return array User information.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Perplexity API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Perplexity API key is not configured.');
        }

        $url = $this->baseUrl.$path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->apiKey,
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
                $error = $response->json('error') ?? $response->body();
                Log::error("Perplexity API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Perplexity API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Perplexity API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Perplexity API: {$e->getMessage()}");
        }
    }
}
