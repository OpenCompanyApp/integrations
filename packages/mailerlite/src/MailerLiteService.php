<?php

namespace OpenCompany\Integrations\MailerLite;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * MailerLite API service for managing subscribers and groups.
 *
 * Wraps the MailerLite v2 REST API with Bearer token authentication.
 * Supports multi-account usage via constructor injection of credentials.
 */
class MailerLiteService
{
    /**
     * Create a new MailerLite service instance.
     *
     * @param  string  $apiKey  MailerLite API key for Bearer token auth.
     * @param  string  $baseUrl  Base URL for the MailerLite API (defaults to v2 endpoint).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.mailerlite.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an API key configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the currently authenticated user / account info.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * List subscribers with optional pagination and status filtering.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @param  string|null  $status  Filter by subscriber status (active, unsubscribed, etc.).
     * @return array<string, mixed>
     */
    public function listSubscribers(int $page = 1, int $limit = 25, ?string $status = null): array
    {
        $params = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($status !== null) {
            $params['filter[status]'] = $status;
        }

        return $this->request('GET', '/subscribers', $params);
    }

    /**
     * Get a single subscriber by ID.
     *
     * @param  int|string  $id  The subscriber ID.
     * @return array<string, mixed>
     */
    public function getSubscriber(int|string $id): array
    {
        return $this->request('GET', '/subscribers/' . urlencode((string) $id));
    }

    /**
     * Create a new subscriber.
     *
     * @param  string  $email  Subscriber email address.
     * @param  string|null  $name  Subscriber name.
     * @param  array<string, mixed>  $fields  Custom field values.
     * @return array<string, mixed>
     */
    public function createSubscriber(string $email, ?string $name = null, array $fields = []): array
    {
        $data = ['email' => $email];

        if ($name !== null) {
            $data['name'] = $name;
        }

        if (!empty($fields)) {
            $data['fields'] = $fields;
        }

        return $this->request('POST', '/subscribers', $data);
    }

    /**
     * Update an existing subscriber.
     *
     * @param  int|string  $id  The subscriber ID.
     * @param  string|null  $name  Updated name.
     * @param  array<string, mixed>  $fields  Updated custom field values.
     * @return array<string, mixed>
     */
    public function updateSubscriber(int|string $id, ?string $name = null, array $fields = []): array
    {
        $data = [];

        if ($name !== null) {
            $data['name'] = $name;
        }

        if (!empty($fields)) {
            $data['fields'] = $fields;
        }

        return $this->request('PUT', '/subscribers/' . urlencode((string) $id), $data);
    }

    /**
     * Delete a subscriber by ID.
     *
     * @param  int|string  $id  The subscriber ID.
     */
    public function deleteSubscriber(int|string $id): void
    {
        $this->request('DELETE', '/subscribers/' . urlencode((string) $id));
    }

    /**
     * List groups with optional pagination.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @return array<string, mixed>
     */
    public function listGroups(int $page = 1, int $limit = 25): array
    {
        return $this->request('GET', '/groups', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Add a subscriber to a group.
     *
     * @param  int|string  $groupId  The group ID.
     * @param  string  $email  Subscriber email address.
     * @param  string|null  $name  Subscriber name.
     * @return array<string, mixed>
     */
    public function addSubscriberToGroup(int|string $groupId, string $email, ?string $name = null): array
    {
        $data = ['email' => $email];

        if ($name !== null) {
            $data['name'] = $name;
        }

        return $this->request('POST', '/groups/' . urlencode((string) $groupId) . '/subscribers', $data);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the MailerLite API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On auth failure, connection error, or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('MailerLite API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("MailerLite API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("MailerLite API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("MailerLite API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to MailerLite API: {$e->getMessage()}");
        }
    }
}
