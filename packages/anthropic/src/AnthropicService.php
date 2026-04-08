<?php

namespace OpenCompany\Integrations\Anthropic;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Anthropic API service for Claude AI — messages, models, and workspaces.
 *
 * Handles authenticated HTTP requests to the Anthropic v1 REST API
 * using an x-api-key header. Supports configurable base URL for
 * custom endpoints or proxies.
 *
 * @see https://docs.anthropic.com/en/docs/about-claude
 */
class AnthropicService
{
    /**
     * Create a new Anthropic service instance.
     *
     * @param  string  $apiKey  Anthropic API key for x-api-key authentication.
     * @param  string  $baseUrl  Base URL for the Anthropic API (default: https://api.anthropic.com/v1).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.anthropic.com/v1',
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
     * List messages in a conversation.
     *
     * @param  array  $params  Query parameters for filtering and pagination
     *                          (e.g., model, limit, before_id, after_id).
     * @return array Paginated list of message resources.
     *
     * @see https://docs.anthropic.com/en/api/list-messages
     */
    public function listMessages(array $params = []): array
    {
        return $this->request('GET', '/messages', $params);
    }

    /**
     * Create a new message (send a prompt to Claude).
     *
     * @param  array  $options  Message options including 'model', 'messages',
     *                           'max_tokens', and optional settings like
     *                           temperature, system, tools, etc.
     * @return array The created message resource.
     *
     * @see https://docs.anthropic.com/en/api/create-message
     */
    public function createMessage(array $options): array
    {
        return $this->request('POST', '/messages', $options);
    }

    /**
     * List available models.
     *
     * @param  array  $params  Query parameters (e.g., limit, before_id, after_id).
     * @return array Paginated list of model resources.
     *
     * @see https://docs.anthropic.com/en/api/list-models
     */
    public function listModels(array $params = []): array
    {
        return $this->request('GET', '/models', $params);
    }

    /**
     * Get details for a specific model.
     *
     * @param  string  $id  The model identifier (e.g., "claude-sonnet-4-20250514").
     * @return array The model resource.
     *
     * @see https://docs.anthropic.com/en/api/get-model
     */
    public function getModel(string $id): array
    {
        return $this->request('GET', '/models/' . urlencode($id));
    }

    /**
     * List workspaces.
     *
     * @param  array  $params  Query parameters (e.g., limit, before_id, after_id).
     * @return array Paginated list of workspace resources.
     *
     * @see https://docs.anthropic.com/en/api/list-workspaces
     */
    public function listWorkspaces(array $params = []): array
    {
        return $this->request('GET', '/workspaces', $params);
    }

    /**
     * Get details for a specific workspace.
     *
     * @param  string  $id  The workspace identifier.
     * @return array The workspace resource.
     *
     * @see https://docs.anthropic.com/en/api/get-workspace
     */
    public function getWorkspace(string $id): array
    {
        return $this->request('GET', '/workspaces/' . urlencode($id));
    }

    /**
     * Get the current authenticated user's profile.
     *
     * @return array User profile data.
     *
     * @see https://docs.anthropic.com/en/api/get-user
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., '/messages').
     * @param  array  $data  Query parameters or JSON body.
     * @return array Decoded JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Anthropic API.
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
            throw new \RuntimeException('Anthropic API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'x-api-key' => $this->apiKey,
                'anthropic-version' => '2023-06-01',
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
                    Log::warning("Anthropic API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Anthropic API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error.message') ?? $response->json('error') ?? $body;
                Log::error("Anthropic API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Anthropic API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Anthropic API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Anthropic API: {$e->getMessage()}");
        }
    }
}
