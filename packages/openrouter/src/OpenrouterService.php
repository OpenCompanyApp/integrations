<?php

namespace OpenCompany\Integrations\Openrouter;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * OpenRouter API service for model routing, generation, and account APIs.
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
     * Create a response through OpenRouter's Responses-compatible endpoint.
     *
     * @param  array<string, mixed>  $options  Response request payload.
     * @return array<string, mixed>
     */
    public function createResponse(array $options): array
    {
        return $this->request('POST', '/responses', $options);
    }

    /**
     * Create a message through OpenRouter's messages endpoint.
     *
     * @param  array<string, mixed>  $options  Message request payload.
     * @return array<string, mixed>
     */
    public function createMessage(array $options): array
    {
        return $this->request('POST', '/messages', $options);
    }

    /**
     * Submit an embedding request.
     *
     * @param  array<string, mixed>  $options  Embedding request payload.
     * @return array<string, mixed>
     */
    public function createEmbedding(array $options): array
    {
        return $this->request('POST', '/embeddings', $options);
    }

    /**
     * List models that support embeddings.
     *
     * @return array<string, mixed>
     */
    public function listEmbeddingModels(): array
    {
        return $this->request('GET', '/embeddings/models');
    }

    /**
     * Submit a rerank request.
     *
     * @param  array<string, mixed>  $options  Rerank request payload.
     * @return array<string, mixed>
     */
    public function rerank(array $options): array
    {
        return $this->request('POST', '/rerank', $options);
    }

    /**
     * List all OpenRouter providers.
     *
     * @return array<string, mixed>
     */
    public function listProviders(): array
    {
        return $this->request('GET', '/providers');
    }

    /**
     * Get remaining account credits.
     *
     * @return array<string, mixed>
     */
    public function getCredits(): array
    {
        return $this->request('GET', '/credits');
    }

    /**
     * Get user activity grouped by endpoint.
     *
     * @param  array<string, mixed>  $params  Activity query filters.
     * @return array<string, mixed>
     */
    public function getActivity(array $params = []): array
    {
        return $this->request('GET', '/activity', $params);
    }

    /**
     * List all endpoints available for a specific model.
     *
     * @param  string  $author  Model author slug.
     * @param  string  $slug  Model slug.
     * @return array<string, mixed>
     */
    public function listModelEndpoints(string $author, string $slug): array
    {
        return $this->request('GET', '/models/'.urlencode($author).'/'.urlencode($slug).'/endpoints');
    }

    /**
     * Count available models.
     *
     * @param  array<string, mixed>  $params  Count query filters.
     * @return array<string, mixed>
     */
    public function countModels(array $params = []): array
    {
        return $this->request('GET', '/models/count', $params);
    }

    /**
     * List models filtered by the user's provider preferences and guardrails.
     *
     * @param  array<string, mixed>  $params  User-model query filters.
     * @return array<string, mixed>
     */
    public function listUserModels(array $params = []): array
    {
        return $this->request('GET', '/models/user', $params);
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
     * Get stored prompt and completion content for a generation.
     *
     * @param  string  $id  Generation identifier.
     * @return array<string, mixed>
     */
    public function getGenerationContent(string $id): array
    {
        return $this->request('GET', '/generation/content', ['id' => $id]);
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
     * Get one API key by hash.
     *
     * @param  string  $hash  API key hash.
     * @return array<string, mixed>
     */
    public function getApiKey(string $hash): array
    {
        return $this->request('GET', '/keys/'.urlencode($hash));
    }

    /**
     * Create an API key.
     *
     * @param  array<string, mixed>  $payload  API key creation payload.
     * @return array<string, mixed>
     */
    public function createApiKey(array $payload): array
    {
        return $this->request('POST', '/keys', $payload);
    }

    /**
     * Update an API key.
     *
     * @param  string  $hash  API key hash.
     * @param  array<string, mixed>  $payload  API key update payload.
     * @return array<string, mixed>
     */
    public function updateApiKey(string $hash, array $payload): array
    {
        return $this->request('PATCH', '/keys/'.urlencode($hash), $payload);
    }

    /**
     * Delete an API key.
     *
     * @param  string  $hash  API key hash.
     * @return array<string, mixed>
     */
    public function deleteApiKey(string $hash): array
    {
        return $this->request('DELETE', '/keys/'.urlencode($hash));
    }

    /**
     * List organization members.
     *
     * @param  array<string, mixed>  $params  Query filters.
     * @return array<string, mixed>
     */
    public function listOrganizationMembers(array $params = []): array
    {
        return $this->request('GET', '/organization/members', $params);
    }

    /**
     * List workspaces.
     *
     * @param  array<string, mixed>  $params  Query filters.
     * @return array<string, mixed>
     */
    public function listWorkspaces(array $params = []): array
    {
        return $this->request('GET', '/workspaces', $params);
    }

    /**
     * Get one workspace.
     *
     * @param  string  $id  Workspace ID.
     * @return array<string, mixed>
     */
    public function getWorkspace(string $id): array
    {
        return $this->request('GET', '/workspaces/'.urlencode($id));
    }

    /**
     * Create a workspace.
     *
     * @param  array<string, mixed>  $payload  Workspace creation payload.
     * @return array<string, mixed>
     */
    public function createWorkspace(array $payload): array
    {
        return $this->request('POST', '/workspaces', $payload);
    }

    /**
     * Update a workspace.
     *
     * @param  string  $id  Workspace ID.
     * @param  array<string, mixed>  $payload  Workspace update payload.
     * @return array<string, mixed>
     */
    public function updateWorkspace(string $id, array $payload): array
    {
        return $this->request('PATCH', '/workspaces/'.urlencode($id), $payload);
    }

    /**
     * Delete a workspace.
     *
     * @param  string  $id  Workspace ID.
     * @return array<string, mixed>
     */
    public function deleteWorkspace(string $id): array
    {
        return $this->request('DELETE', '/workspaces/'.urlencode($id));
    }

    /**
     * List guardrails.
     *
     * @param  array<string, mixed>  $params  Query filters.
     * @return array<string, mixed>
     */
    public function listGuardrails(array $params = []): array
    {
        return $this->request('GET', '/guardrails', $params);
    }

    /**
     * List video generation models.
     *
     * @return array<string, mixed>
     */
    public function listVideoModels(): array
    {
        return $this->request('GET', '/videos/models');
    }

    /**
     * Submit a video generation request.
     *
     * @param  array<string, mixed>  $payload  Video generation payload.
     * @return array<string, mixed>
     */
    public function createVideo(array $payload): array
    {
        return $this->request('POST', '/videos', $payload);
    }

    /**
     * Poll video generation status.
     *
     * @param  string  $jobId  Video job ID.
     * @return array<string, mixed>
     */
    public function getVideo(string $jobId): array
    {
        return $this->request('GET', '/videos/'.urlencode($jobId));
    }

    /**
     * Call a safe relative OpenRouter GET path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $query);
    }

    /**
     * Call a safe relative OpenRouter POST path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON payload.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Call a safe relative OpenRouter PATCH path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON payload.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Call a safe relative OpenRouter DELETE path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $query);
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
                'PATCH' => $http->patch($url, $data),
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

    /**
     * Normalize and validate caller-provided relative paths.
     *
     * @param  string  $path  Relative API path.
     */
    private function normalizePath(string $path): string
    {
        $path = '/'.ltrim($path, '/');

        if (str_contains($path, '..') || preg_match('#^/https?://#i', $path) === 1) {
            throw new \RuntimeException('Only safe relative OpenRouter API paths are supported.');
        }

        return $path;
    }
}
