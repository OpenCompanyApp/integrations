<?php

namespace OpenCompany\Integrations\Perplexity;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Perplexity APIs.
 *
 * Handles bearer authentication, endpoint mapping, error logging, and JSON parsing.
 * Tool classes delegate all API communication to this service.
 */
class PerplexityService
{
    /**
     * @param  string  $apiKey  Perplexity API key.
     * @param  string  $baseUrl  Perplexity API base URL.
     */
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
     * Create a Sonar chat completion.
     *
     * @param  array<int, array<string, mixed>>  $messages  Conversation messages.
     * @param  string  $model  Sonar model id.
     * @param  array<string, mixed>  $options  Additional request options.
     * @return array<string, mixed>
     */
    public function chat(array $messages, string $model = 'sonar', array $options = []): array
    {
        $body = array_merge([
            'model' => $model,
            'messages' => $messages,
        ], $options);

        return $this->request('POST', '/v1/sonar', $body);
    }

    /**
     * Ask a single question using the Sonar chat endpoint.
     *
     * @param  string  $query  User question or prompt.
     * @param  array<string, mixed>  $options  Additional chat request options.
     * @return array<string, mixed>
     */
    public function ask(string $query, array $options = []): array
    {
        $model = $options['model'] ?? 'sonar';
        unset($options['model']);

        return $this->chat([
            ['role' => 'user', 'content' => $query],
        ], $model, $options);
    }

    /**
     * Search the web and retrieve relevant web page contents.
     *
     * @param  array<string, mixed>  $payload  Search request payload.
     * @return array<string, mixed>
     */
    public function search(array $payload): array
    {
        return $this->request('POST', '/search', $payload);
    }

    /**
     * Submit an asynchronous Sonar chat completion request.
     *
     * @param  array<string, mixed>  $request  Sonar chat request body.
     * @param  string|null  $idempotencyKey  Optional duplicate-prevention key.
     * @return array<string, mixed>
     */
    public function createAsyncSonar(array $request, ?string $idempotencyKey = null): array
    {
        $payload = ['request' => $request];

        if ($idempotencyKey !== null && $idempotencyKey !== '') {
            $payload['idempotency_key'] = $idempotencyKey;
        }

        return $this->request('POST', '/v1/async/sonar', $payload);
    }

    /**
     * List asynchronous Sonar chat completion requests.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAsyncSonar(array $params = []): array
    {
        return $this->request('GET', '/v1/async/sonar', $params);
    }

    /**
     * Retrieve one asynchronous Sonar chat completion request.
     *
     * @param  string  $requestId  Async request id.
     * @return array<string, mixed>
     */
    public function getAsyncSonar(string $requestId): array
    {
        return $this->request('GET', '/v1/async/sonar/'.rawurlencode($requestId));
    }

    /**
     * Create an Agent API response.
     *
     * @param  array<string, mixed>  $payload  Agent response payload.
     * @return array<string, mixed>
     */
    public function agent(array $payload): array
    {
        return $this->request('POST', '/v1/agent', $payload);
    }

    /**
     * Create embeddings for one or more texts.
     *
     * @param  array<string, mixed>  $payload  Embeddings request payload.
     * @return array<string, mixed>
     */
    public function embeddings(array $payload): array
    {
        return $this->request('POST', '/v1/embeddings', $payload);
    }

    /**
     * Create contextualized embeddings for grouped document chunks.
     *
     * @param  array<string, mixed>  $payload  Contextualized embeddings request payload.
     * @return array<string, mixed>
     */
    public function contextualizedEmbeddings(array $payload): array
    {
        return $this->request('POST', '/v1/contextualizedembeddings', $payload);
    }

    /**
     * List Agent API models.
     *
     * @return array<string, mixed>
     */
    public function listModels(): array
    {
        return $this->request('GET', '/v1/models');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Perplexity API.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->apiKey) {
            throw new RuntimeException('Perplexity API key is not configured.');
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
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('error') ?? $response->body();
                Log::error("Perplexity API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Perplexity API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Perplexity API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Perplexity API: {$e->getMessage()}");
        }
    }
}
