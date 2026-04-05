<?php

namespace OpenCompany\Integrations\MistralAI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MistralAIService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.mistral.ai/v1',
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
     * Send a chat completion request.
     *
     * @param  string  $model  The model to use (e.g., "mistral-large-latest", "mistral-small-latest").
     * @param  array<int, array{role: string, content: string}>  $messages  The conversation messages.
     * @param  float|null  $temperature  Sampling temperature (0.0–1.0).
     * @param  int|null  $maxTokens  Maximum number of tokens to generate.
     * @return array<string, mixed> The API response.
     */
    public function chat(string $model, array $messages, ?float $temperature = null, ?int $maxTokens = null): array
    {
        $body = [
            'model' => $model,
            'messages' => $messages,
        ];

        if ($temperature !== null) {
            $body['temperature'] = $temperature;
        }

        if ($maxTokens !== null) {
            $body['max_tokens'] = $maxTokens;
        }

        return $this->request('POST', '/chat/completions', $body);
    }

    /**
     * Create embeddings for the given input.
     *
     * @param  string  $model  The embedding model (e.g., "mistral-embed").
     * @param  string|array<int, string>  $input  The text or array of texts to embed.
     * @return array<string, mixed> The API response containing embedding vectors.
     */
    public function createEmbedding(string $model, string|array $input): array
    {
        return $this->request('POST', '/embeddings', [
            'model' => $model,
            'input' => $input,
        ]);
    }

    /**
     * List available models.
     *
     * @return array<string, mixed> The API response with model listings.
     */
    public function listModels(): array
    {
        return $this->request('GET', '/models');
    }

    /**
     * Create a fine-tuning job.
     *
     * @param  array<string, mixed> $body  The fine-tuning job configuration.
     * @return array<string, mixed> The API response with the created job details.
     */
    public function finetune(array $body): array
    {
        return $this->request('POST', '/fine_tuning/jobs', $body);
    }

    /**
     * List agents.
     *
     * @return array<string, mixed> The API response with agent listings.
     */
    public function listAgents(): array
    {
        return $this->request('GET', '/agents');
    }

    /**
     * Create a new agent.
     *
     * @param  string  $name  The agent name.
     * @param  string  $model  The model to use for the agent.
     * @param  string  $instructions  System instructions for the agent.
     * @param  array<string, mixed>  $additionalParams  Additional parameters (e.g., description, tools).
     * @return array<string, mixed> The API response with the created agent details.
     */
    public function createAgent(string $name, string $model, string $instructions, array $additionalParams = []): array
    {
        $body = array_merge([
            'name' => $name,
            'model' => $model,
            'instructions' => $instructions,
        ], $additionalParams);

        return $this->request('POST', '/agents', $body);
    }

    /**
     * Get the current authenticated user's information.
     *
     * @return array<string, mixed> The API response with user details.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user/info');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., "/chat/completions").
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the MistralAI API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('MistralAI API key is not configured.');
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
                    Log::warning("MistralAI API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("MistralAI API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("MistralAI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("MistralAI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("MistralAI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to MistralAI API: {$e->getMessage()}");
        }
    }
}
