<?php

namespace OpenCompany\Integrations\Fellow;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for Fellow's Developer API.
 *
 * Handles workspace subdomain URL construction, X-API-KEY authentication,
 * request dispatch, error logging, and response parsing.
 */
class FellowService
{
    /**
     * @param  string  $apiKey  Fellow Developer API key.
     * @param  string  $subdomain  Fellow workspace subdomain.
     * @param  string  $baseUrl  Optional fully-qualified API base URL override.
     */
    public function __construct(
        private string $apiKey = '',
        private string $subdomain = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl !== '' ? $this->baseUrl : $this->baseUrlFromSubdomain($subdomain), '/');
    }

    /**
     * Check whether the service has the required API key and API base URL.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '' && $this->baseUrl !== '';
    }

    // User

    /**
     * Get the authenticated user and workspace.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    // Notes

    /**
     * List notes with optional filters, includes, and pagination.
     *
     * @param  array<string, mixed>  $payload  Request body (pagination, include, filters).
     * @return array<string, mixed>
     */
    public function listNotes(array $payload = []): array
    {
        return $this->request('POST', '/notes', $payload);
    }

    /**
     * Retrieve a note by ID.
     *
     * @param  string  $noteId  Fellow note ID.
     * @return array<string, mixed>
     */
    public function getNote(string $noteId): array
    {
        return $this->request('GET', '/note/'.urlencode($noteId));
    }

    /**
     * Delete a note by ID.
     *
     * @param  string  $noteId  Fellow note ID.
     * @return array<string, mixed>
     */
    public function deleteNote(string $noteId): array
    {
        return $this->request('DELETE', '/note/'.urlencode($noteId));
    }

    // Action items

    /**
     * List action items with optional filters and pagination.
     *
     * @param  array<string, mixed>  $payload  Request body (pagination, include, order_by, filters).
     * @return array<string, mixed>
     */
    public function listActionItems(array $payload = []): array
    {
        return $this->request('POST', '/action_items', $payload);
    }

    /**
     * Retrieve an action item by ID.
     *
     * @param  string  $actionItemId  Fellow action item ID.
     * @return array<string, mixed>
     */
    public function getActionItem(string $actionItemId): array
    {
        return $this->request('GET', '/action_item/'.urlencode($actionItemId));
    }

    /**
     * Mark an action item complete or incomplete.
     *
     * @param  string  $actionItemId  Fellow action item ID.
     * @param  bool  $completed  Desired completion state.
     * @return array<string, mixed>
     */
    public function markActionItemComplete(string $actionItemId, bool $completed): array
    {
        return $this->request('POST', '/action_item/'.urlencode($actionItemId).'/complete', [
            'completed' => $completed,
        ]);
    }

    /**
     * Archive an action item by marking it as won't do.
     *
     * @param  string  $actionItemId  Fellow action item ID.
     * @return array<string, mixed>
     */
    public function archiveActionItem(string $actionItemId): array
    {
        return $this->request('POST', '/action_item/'.urlencode($actionItemId).'/archive');
    }

    // Recordings

    /**
     * List recordings with optional filters, includes, pagination, and media URL settings.
     *
     * @param  array<string, mixed>  $payload  Request body (pagination, include, filters, media_url).
     * @return array<string, mixed>
     */
    public function listRecordings(array $payload = []): array
    {
        return $this->request('POST', '/recordings', $payload);
    }

    /**
     * Retrieve a recording by ID.
     *
     * @param  string  $recordingId  Fellow recording ID.
     * @return array<string, mixed>
     */
    public function getRecording(string $recordingId): array
    {
        return $this->request('GET', '/recording/'.urlencode($recordingId));
    }

    /**
     * Delete a recording by ID.
     *
     * @param  string  $recordingId  Fellow recording ID.
     * @return array<string, mixed>
     */
    public function deleteRecording(string $recordingId): array
    {
        return $this->request('DELETE', '/recording/'.urlencode($recordingId));
    }

    // Webhooks

    /**
     * List webhooks with optional query filters and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (page_size, cursor, filters).
     * @return array<string, mixed>
     */
    public function listWebhooks(array $params = []): array
    {
        return $this->request('GET', '/webhooks', $params);
    }

    /**
     * Create a webhook endpoint.
     *
     * @param  array<string, mixed>  $payload  Webhook payload (url, enabled_events, description, status).
     * @return array<string, mixed>
     */
    public function createWebhook(array $payload): array
    {
        return $this->request('POST', '/webhook', $payload);
    }

    /**
     * Retrieve a webhook by ID.
     *
     * @param  string  $webhookId  Fellow webhook ID.
     * @return array<string, mixed>
     */
    public function getWebhook(string $webhookId): array
    {
        return $this->request('GET', '/webhook/'.urlencode($webhookId));
    }

    /**
     * Update a webhook endpoint.
     *
     * @param  string  $webhookId  Fellow webhook ID.
     * @param  array<string, mixed>  $payload  Partial webhook payload.
     * @return array<string, mixed>
     */
    public function updateWebhook(string $webhookId, array $payload): array
    {
        return $this->request('PATCH', '/webhook/'.urlencode($webhookId), $payload);
    }

    /**
     * Delete a webhook endpoint.
     *
     * @param  string  $webhookId  Fellow webhook ID.
     * @return array<string, mixed>
     */
    public function deleteWebhook(string $webhookId): array
    {
        return $this->request('DELETE', '/webhook/'.urlencode($webhookId));
    }

    // Generic API

    /**
     * Send a GET request to a relative Fellow API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Send a POST request to a relative Fellow API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Send a PATCH request to a relative Fellow API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Send a DELETE request to a relative Fellow API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  Optional request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Fellow API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Fellow API key and workspace subdomain or API URL are required.');
        }

        $method = strtoupper($method);
        $url = $this->baseUrl.$path;

        try {
            $http = Http::withHeaders([
                'X-API-KEY' => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match ($method) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();

                Log::error("Fellow API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Fellow API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Fellow API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Fellow API: {$e->getMessage()}");
        }
    }

    /**
     * Build a Fellow API base URL from a workspace subdomain.
     */
    private function baseUrlFromSubdomain(string $subdomain): string
    {
        $subdomain = trim($subdomain);

        if ($subdomain === '') {
            return '';
        }

        $subdomain = preg_replace('/\.fellow\.app$/', '', $subdomain) ?? $subdomain;
        $subdomain = preg_replace('#^https?://#', '', $subdomain) ?? $subdomain;
        $subdomain = trim($subdomain, '/');

        return "https://{$subdomain}.fellow.app/api/v1";
    }

    /**
     * Normalize and validate a caller-supplied relative path.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || str_contains($path, '://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Fellow API path must be a relative path such as /notes.');
        }

        return str_starts_with($path, '/') ? $path : '/'.$path;
    }
}
