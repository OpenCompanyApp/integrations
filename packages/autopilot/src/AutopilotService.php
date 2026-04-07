<?php

namespace OpenCompany\Integrations\Autopilot;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AutopilotService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.autopilotapp.com/v1',
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
     * List contacts in the account.
     *
     * @param  int  $limit  Number of contacts to return (max 100).
     * @param  string|null  $bookmark  Pagination bookmark from a previous response.
     * @return array<string, mixed>
     */
    public function listContacts(int $limit = 50, ?string $bookmark = null): array
    {
        $params = ['limit' => min($limit, 100)];
        if ($bookmark !== null) {
            $params['bookmark'] = $bookmark;
        }

        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a contact by ID or email.
     *
     * @param  string  $contactId  The contact ID or email address.
     * @return array<string, mixed>
     */
    public function getContact(string $contactId): array
    {
        return $this->request('GET', '/contact/' . urlencode($contactId));
    }

    /**
     * Create or update a contact.
     *
     * @param  array  $data  Contact data including email, and optional fields.
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contact', $data);
    }

    /**
     * List all lists in the account.
     *
     * @return array<string, mixed>
     */
    public function listLists(): array
    {
        return $this->request('GET', '/lists');
    }

    /**
     * Get details and contacts for a specific list.
     *
     * @param  string  $listId  The list ID.
     * @return array<string, mixed>
     */
    public function getList(string $listId): array
    {
        return $this->request('GET', '/list/' . urlencode($listId));
    }

    /**
     * List all journeys in the account.
     *
     * @return array<string, mixed>
     */
    public function listJourneys(): array
    {
        return $this->request('GET', '/journeys');
    }

    /**
     * Get the authenticated user's account details.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/account');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Autopilot API using Bearer auth.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Autopilot API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withToken($this->apiKey)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'autopilot-sdk-version' => '2.0',
                ])
                ->timeout(30);

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
                    Log::warning("Autopilot API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Autopilot API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Autopilot API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Autopilot API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Autopilot API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Autopilot API: {$e->getMessage()}");
        }
    }
}
