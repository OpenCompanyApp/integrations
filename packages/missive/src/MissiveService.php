<?php

namespace OpenCompany\Integrations\Missive;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service client for the Missive Public API.
 *
 * Handles authentication, HTTP requests, and error handling for all
 * Missive API interactions (conversations, comments, tasks, users).
 *
 * @see https://missiveapp.com/help/api/rest
 */
class MissiveService
{
    /**
     * Create a new MissiveService instance.
     *
     * @param  string  $accessToken  Bearer token for the Missive Public API.
     * @param  string  $baseUrl      Base URL for the Missive API (configurable for testing).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://public.missiveapp.com/v1',
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
     * List conversations with optional filters and pagination.
     *
     * @param  array  $params  Query parameters (inbox, assignee, state, limit, offset, etc.).
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listConversations(array $params = []): array
    {
        return $this->request('GET', '/conversations', $params);
    }

    /**
     * Get a single conversation by ID.
     *
     * @param  string  $id  The conversation UUID.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function getConversation(string $id): array
    {
        return $this->request('GET', '/conversations/' . urlencode($id));
    }

    /**
     * Create a comment on a conversation.
     *
     * @param  array  $data  Comment payload (conversation_id, body, etc.).
     * @return array<string, mixed> Parsed JSON response.
     */
    public function createComment(array $data): array
    {
        return $this->request('POST', '/comments', $data);
    }

    /**
     * List tasks with optional filters and pagination.
     *
     * @param  array  $params  Query parameters (state, assignee, limit, offset, etc.).
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listTasks(array $params = []): array
    {
        return $this->request('GET', '/tasks', $params);
    }

    /**
     * Create a new task.
     *
     * @param  array  $data  Task payload (title, description, assignee, due_date, etc.).
     * @return array<string, mixed> Parsed JSON response.
     */
    public function createTask(array $data): array
    {
        return $this->request('POST', '/tasks', $data);
    }

    /**
     * Get the currently authenticated user's profile.
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
     * @param  string  $path    API endpoint path (relative to base URL).
     * @param  array   $data    Query parameters (GET) or JSON body (POST/PUT).
     * @return array<string, mixed> Parsed JSON response.
     *
     * @throws \RuntimeException On connection failure or API error.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Missive API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (relative to base URL).
     * @param  array   $data    Query parameters (GET) or JSON body (POST/PUT).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException On connection failure or non-successful response.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Missive access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Missive API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Missive API endpoint not available (HTTP {$response->status()}). Check the API URL.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Missive API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Missive API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Missive API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Missive API: {$e->getMessage()}");
        }
    }
}
