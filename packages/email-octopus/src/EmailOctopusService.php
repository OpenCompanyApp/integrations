<?php

namespace OpenCompany\Integrations\EmailOctopus;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EmailOctopusService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://emailoctopus.com/api',
        private string $listId = '',
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
     * Get the configured default list ID.
     */
    public function getListId(): string
    {
        return $this->listId;
    }

    /**
     * List contacts in a mailing list.
     *
     * @param string|null $listId Override the default list ID.
     * @param int $limit Maximum number of contacts to return (max 100).
     * @param string|null $before Cursor for pagination — contact ID to paginate before.
     * @param string|null $after Cursor for pagination — contact ID to paginate after.
     * @return array The API response containing contacts and pagination info.
     */
    public function listContacts(?string $listId = null, int $limit = 100, ?string $before = null, ?string $after = null): array
    {
        $listId = $listId ?? $this->listId;

        $params = ['limit' => min($limit, 100)];
        if ($before) {
            $params['before'] = $before;
        }
        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/v1.5/lists/' . urlencode($listId) . '/contacts', $params);
    }

    /**
     * Get a single contact from a mailing list.
     *
     * @param string $contactId The contact ID.
     * @param string|null $listId Override the default list ID.
     * @return array The contact data.
     */
    public function getContact(string $contactId, ?string $listId = null): array
    {
        $listId = $listId ?? $this->listId;

        return $this->request('GET', '/v1.5/lists/' . urlencode($listId) . '/contacts/' . urlencode($contactId));
    }

    /**
     * Create (or subscribe) a contact on a mailing list.
     *
     * @param string $emailAddress The contact's email address.
     * @param array $fields Optional merge fields (e.g., first_name, last_name).
     * @param string|null $listId Override the default list ID.
     * @return array The created contact data.
     */
    public function createContact(string $emailAddress, array $fields = [], ?string $listId = null): array
    {
        $listId = $listId ?? $this->listId;

        $data = array_merge(['email_address' => $emailAddress], $fields);

        return $this->request('POST', '/v1.5/lists/' . urlencode($listId) . '/contacts', $data);
    }

    /**
     * List all campaigns.
     *
     * @param int $limit Maximum number of campaigns to return (max 100).
     * @param string|null $before Cursor for pagination.
     * @param string|null $after Cursor for pagination.
     * @return array The API response containing campaigns and pagination info.
     */
    public function listCampaigns(int $limit = 100, ?string $before = null, ?string $after = null): array
    {
        $params = ['limit' => min($limit, 100)];
        if ($before) {
            $params['before'] = $before;
        }
        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/v1.5/campaigns', $params);
    }

    /**
     * Get a single campaign by ID.
     *
     * @param string $campaignId The campaign ID.
     * @return array The campaign data.
     */
    public function getCampaign(string $campaignId): array
    {
        return $this->request('GET', '/v1.5/campaigns/' . urlencode($campaignId));
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array The user data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1.5/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the EmailOctopus API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('EmailOctopus API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        // EmailOctopus uses query param for auth on GET, or body param on POST
        $isGet = strtoupper($method) === 'GET';

        if ($isGet) {
            $data['api_key'] = $this->apiKey;
        }

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30);

            if (!$isGet) {
                $data['api_key'] = $this->apiKey;
            }

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
                    Log::warning("EmailOctopus API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("EmailOctopus API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("EmailOctopus API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("EmailOctopus API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("EmailOctopus API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to EmailOctopus API: {$e->getMessage()}");
        }
    }
}
