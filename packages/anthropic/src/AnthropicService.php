<?php

namespace OpenCompany\Integrations\Anthropic;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Anthropic API service for Claude AI, files, batches, and organization APIs.
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
        private string $adminKey = '',
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
     * Check whether an Admin API key is available for organization endpoints.
     */
    public function isAdminConfigured(): bool
    {
        return !empty($this->adminKey);
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
        throw new \RuntimeException('Anthropic does not provide a message history listing endpoint. Use message batch tools for batch job history.');
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
     * Count input tokens for a Messages API request without creating a message.
     *
     * @param  array<string, mixed>  $options  Message options including model and messages.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/docs/build-with-claude/token-counting
     */
    public function countMessageTokens(array $options): array
    {
        return $this->request('POST', '/messages/count_tokens', $options);
    }

    /**
     * Create a Message Batch for asynchronous bulk message processing.
     *
     * @param  array<string, mixed>  $options  Batch creation payload with requests.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/creating-message-batches
     */
    public function createMessageBatch(array $options): array
    {
        return $this->request('POST', '/messages/batches', $options);
    }

    /**
     * List Message Batches in the workspace for this API key.
     *
     * @param  array<string, mixed>  $params  Pagination parameters.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/listing-message-batches
     */
    public function listMessageBatches(array $params = []): array
    {
        return $this->request('GET', '/messages/batches', $params);
    }

    /**
     * Retrieve one Message Batch.
     *
     * @param  string  $id  Message Batch ID.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/retrieving-message-batches
     */
    public function getMessageBatch(string $id): array
    {
        return $this->request('GET', '/messages/batches/'.urlencode($id));
    }

    /**
     * Cancel an in-progress Message Batch.
     *
     * @param  string  $id  Message Batch ID.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/canceling-message-batches
     */
    public function cancelMessageBatch(string $id): array
    {
        return $this->request('POST', '/messages/batches/'.urlencode($id).'/cancel');
    }

    /**
     * Delete a completed Message Batch.
     *
     * @param  string  $id  Message Batch ID.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/deleting-message-batches
     */
    public function deleteMessageBatch(string $id): array
    {
        return $this->request('DELETE', '/messages/batches/'.urlencode($id));
    }

    /**
     * Retrieve Message Batch results as JSONL text.
     *
     * @param  string  $id  Message Batch ID.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/retrieving-message-batch-results
     */
    public function getMessageBatchResults(string $id): array
    {
        $response = $this->rawRequest('GET', '/messages/batches/'.urlencode($id).'/results');

        return [
            'content_type' => $response->header('Content-Type'),
            'body' => $response->body(),
        ];
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
     * Get details for a specific workspace.
     *
     * @param  string  $id  The workspace identifier.
     * @return array The workspace resource.
     *
     * @see https://docs.anthropic.com/en/api/get-workspace
     */
    public function getWorkspace(string $id): array
    {
        return $this->adminRequest('GET', '/organizations/workspaces/'.urlencode($id));
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
        return $this->getOrganization();
    }

    /**
     * Get Anthropic organization information for the Admin API key.
     *
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/admin-api/organization/get-me
     */
    public function getOrganization(): array
    {
        return $this->adminRequest('GET', '/organizations/me');
    }

    /**
     * List Anthropic organization workspaces.
     *
     * @param  array<string, mixed>  $params  Pagination and include_archived filters.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/admin-api/workspaces/list-workspaces
     */
    public function listWorkspaces(array $params = []): array
    {
        return $this->adminRequest('GET', '/organizations/workspaces', $params);
    }

    /**
     * List organization users.
     *
     * @param  array<string, mixed>  $params  Pagination filters.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/admin-api/users/list-users
     */
    public function listUsers(array $params = []): array
    {
        return $this->adminRequest('GET', '/organizations/users', $params);
    }

    /**
     * Get one organization user.
     *
     * @param  string  $id  User ID.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/admin-api/users/get-user
     */
    public function getUser(string $id): array
    {
        return $this->adminRequest('GET', '/organizations/users/'.urlencode($id));
    }

    /**
     * Update an organization user's role.
     *
     * @param  string  $id  User ID.
     * @param  array<string, mixed>  $payload  Role update payload.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/admin-api/users/update-user
     */
    public function updateUser(string $id, array $payload): array
    {
        return $this->adminRequest('POST', '/organizations/users/'.urlencode($id), $payload);
    }

    /**
     * Remove an organization user.
     *
     * @param  string  $id  User ID.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/admin-api/users/remove-user
     */
    public function removeUser(string $id): array
    {
        return $this->adminRequest('DELETE', '/organizations/users/'.urlencode($id));
    }

    /**
     * List organization API keys.
     *
     * @param  array<string, mixed>  $params  Pagination and status filters.
     * @return array<string, mixed>
     */
    public function listApiKeys(array $params = []): array
    {
        return $this->adminRequest('GET', '/organizations/api_keys', $params);
    }

    /**
     * Get one organization API key.
     *
     * @param  string  $id  API key ID.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/admin-api/apikeys/get-api-key
     */
    public function getApiKey(string $id): array
    {
        return $this->adminRequest('GET', '/organizations/api_keys/'.urlencode($id));
    }

    /**
     * List files in the API key's workspace.
     *
     * @param  array<string, mixed>  $params  Pagination parameters.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/api/files-list
     */
    public function listFiles(array $params = []): array
    {
        return $this->request('GET', '/files', $params, ['anthropic-beta' => 'files-api-2025-04-14']);
    }

    /**
     * Get file metadata.
     *
     * @param  string  $id  File ID.
     * @return array<string, mixed>
     */
    public function getFile(string $id): array
    {
        return $this->request('GET', '/files/'.urlencode($id), [], ['anthropic-beta' => 'files-api-2025-04-14']);
    }

    /**
     * Delete a file.
     *
     * @param  string  $id  File ID.
     * @return array<string, mixed>
     */
    public function deleteFile(string $id): array
    {
        return $this->request('DELETE', '/files/'.urlencode($id), [], ['anthropic-beta' => 'files-api-2025-04-14']);
    }

    /**
     * Download file content for downloadable code-execution outputs.
     *
     * @param  string  $id  File ID.
     * @return array<string, mixed>
     *
     * @see https://docs.anthropic.com/en/docs/build-with-claude/files
     */
    public function downloadFile(string $id): array
    {
        $response = $this->rawRequest('GET', '/files/'.urlencode($id).'/content', [], ['anthropic-beta' => 'files-api-2025-04-14']);

        return [
            'content_type' => $response->header('Content-Type'),
            'body' => $response->body(),
        ];
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., '/messages').
     * @param  array  $data  Query parameters or JSON body.
     * @return array Decoded JSON response.
     */
    private function request(string $method, string $path, array $data = [], array $headers = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $headers);

        return $response->json() ?? [];
    }

    /**
     * Make an authenticated Admin API request.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function adminRequest(string $method, string $path, array $data = []): array
    {
        if (!$this->adminKey) {
            throw new \RuntimeException('Anthropic Admin API key is not configured.');
        }

        return $this->request($method, $path, $data, ['x-api-key' => $this->adminKey]);
    }

    /**
     * Make a raw HTTP request to the Anthropic API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data (query params for GET, JSON body for POST/PUT/DELETE).
     * @param  array<string, string>  $headers  Additional or overriding request headers.
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = [], array $headers = []): \Illuminate\Http\Client\Response
    {
        $apiKey = $headers['x-api-key'] ?? $this->apiKey;

        if (!$apiKey) {
            throw new \RuntimeException('Anthropic API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'x-api-key' => $apiKey,
                'anthropic-version' => '2023-06-01',
                'Content-Type' => 'application/json',
            ] + $headers)->timeout(120);

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
