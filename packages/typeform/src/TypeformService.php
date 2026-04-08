<?php

namespace OpenCompany\Integrations\Typeform;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Typeform REST API.
 *
 * Wraps HTTP calls to Typeform's endpoints for forms, responses,
 * workspaces, and webhooks.
 */
class TypeformService
{
    private const BASE_URL = 'https://api.typeform.com';

    /**
     * @param  string  $accessToken  Typeform Personal Access Token
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Connection Test ─────────────────────────────────────

    /**
     * Test the connection by fetching the authenticated user profile.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/me');
    }

    // ── Forms ───────────────────────────────────────────────

    /**
     * List forms with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, page_size, search, workspace_id)
     * @return array<string, mixed>
     */
    public function listForms(array $params = []): array
    {
        return $this->request('GET', '/forms', $params);
    }

    /**
     * Get a single form by ID.
     *
     * @param  string  $formId  Typeform form ID
     * @return array<string, mixed>
     */
    public function getForm(string $formId): array
    {
        return $this->request('GET', "/forms/{$formId}");
    }

    // ── Responses ───────────────────────────────────────────

    /**
     * List responses for a form with optional filtering and pagination.
     *
     * @param  string  $formId  Typeform form ID
     * @param  array<string, mixed>  $params  Query parameters (page_size, after, before, completed, sort, query)
     * @return array<string, mixed>
     */
    public function listResponses(string $formId, array $params = []): array
    {
        return $this->request('GET', "/forms/{$formId}/responses", $params);
    }

    /**
     * Get a single response by ID.
     *
     * @param  string  $formId      Typeform form ID
     * @param  string  $responseId  Typeform response ID
     * @return array<string, mixed>
     */
    public function getResponse(string $formId, string $responseId): array
    {
        return $this->request('GET', "/forms/{$formId}/responses/{$responseId}");
    }

    /**
     * Delete a response by ID.
     *
     * @param  string  $formId      Typeform form ID
     * @param  string  $responseId  Typeform response ID
     * @return array<string, mixed>
     */
    public function deleteResponse(string $formId, string $responseId): array
    {
        return $this->request('DELETE', "/forms/{$formId}/responses/{$responseId}");
    }

    // ── Workspaces ──────────────────────────────────────────

    /**
     * List workspaces with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, page_size, search)
     * @return array<string, mixed>
     */
    public function listWorkspaces(array $params = []): array
    {
        return $this->request('GET', '/workspaces', $params);
    }

    /**
     * Get a single workspace by ID.
     *
     * @param  string  $workspaceId  Typeform workspace ID
     * @return array<string, mixed>
     */
    public function getWorkspace(string $workspaceId): array
    {
        return $this->request('GET', "/workspaces/{$workspaceId}");
    }

    // ── Webhooks ────────────────────────────────────────────

    /**
     * Create or update a webhook for a form.
     *
     * @param  string  $formId  Typeform form ID
     * @param  string  $tag     Unique webhook tag
     * @param  string  $url     Webhook endpoint URL
     * @param  bool    $enabled Whether the webhook is enabled
     * @return array<string, mixed>
     */
    public function createWebhook(string $formId, string $tag, string $url, bool $enabled = true): array
    {
        return $this->request('PUT', "/forms/{$formId}/webhooks/{$tag}", [
            'url' => $url,
            'enabled' => $enabled,
        ]);
    }

    /**
     * List webhooks for a form.
     *
     * @param  string  $formId  Typeform form ID
     * @return array<string, mixed>
     */
    public function listWebhooks(string $formId): array
    {
        return $this->request('GET', "/forms/{$formId}/webhooks");
    }

    /**
     * Delete a webhook by tag.
     *
     * @param  string  $formId  Typeform form ID
     * @param  string  $tag     Unique webhook tag
     * @return array<string, mixed>
     */
    public function deleteWebhook(string $formId, string $tag): array
    {
        return $this->request('DELETE', "/forms/{$formId}/webhooks/{$tag}");
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Typeform.
     *
     * @param  array<string, mixed>  $data  Query parameters (GET) or body payload (POST/PUT/PATCH/DELETE)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Typeform access token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $body = $response->json() ?? [];

            if ($response->failed()) {
                $error = $body['error'] ?? $body['message'] ?? $response->body();

                Log::error("Typeform API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Typeform API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $body;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Typeform API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Typeform API: {$e->getMessage()}");
        }
    }
}
