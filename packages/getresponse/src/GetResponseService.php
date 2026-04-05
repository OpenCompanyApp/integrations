<?php

namespace OpenCompany\Integrations\GetResponse;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetResponseService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.getresponse.com/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List contacts with pagination.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Results per page (max 1000).
     * @return array<string, mixed>
     */
    public function listContacts(int $page = 1, int $perPage = 50): array
    {
        return $this->request('GET', '/contacts', [
            'page' => $page,
            'perPage' => $perPage,
        ]);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  string  $id  The contact identifier.
     * @return array<string, mixed>
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', '/contacts/' . urlencode($id));
    }

    /**
     * Create a new contact.
     *
     * @param  string  $email  Contact email address.
     * @param  string|null  $name  Contact name (optional).
     * @param  string|null  $campaign  Campaign ID to add the contact to (optional).
     * @return array<string, mixed>
     */
    public function createContact(string $email, ?string $name = null, ?string $campaign = null): array
    {
        $data = ['email' => $email];

        if ($name !== null) {
            $data['name'] = $name;
        }

        if ($campaign !== null) {
            $data['campaign'] = ['campaignId' => $campaign];
        }

        return $this->request('POST', '/contacts', $data);
    }

    /**
     * Update an existing contact.
     *
     * @param  string  $id  The contact identifier.
     * @param  string|null  $name  New name for the contact (optional).
     * @return array<string, mixed>
     */
    public function updateContact(string $id, ?string $name = null): array
    {
        $data = [];

        if ($name !== null) {
            $data['name'] = $name;
        }

        return $this->request('POST', '/contacts/' . urlencode($id), $data);
    }

    /**
     * Delete a contact.
     *
     * @param  string  $id  The contact identifier.
     */
    public function deleteContact(string $id): void
    {
        $this->request('DELETE', '/contacts/' . urlencode($id));
    }

    /**
     * List all campaigns.
     *
     * @return array<string, mixed>
     */
    public function listCampaigns(): array
    {
        return $this->request('GET', '/campaigns');
    }

    /**
     * Get a single campaign by ID.
     *
     * @param  string  $id  The campaign identifier.
     * @return array<string, mixed>
     */
    public function getCampaign(string $id): array
    {
        return $this->request('GET', '/campaigns/' . urlencode($id));
    }

    /**
     * Create a new campaign.
     *
     * @param  string  $name  The campaign name.
     * @return array<string, mixed>
     */
    public function createCampaign(string $name): array
    {
        return $this->request('POST', '/campaigns', [
            'name' => $name,
        ]);
    }

    /**
     * List newsletters.
     *
     * @return array<string, mixed>
     */
    public function listNewsletters(): array
    {
        return $this->request('GET', '/newsletters');
    }

    /**
     * Get the current authenticated user account.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/accounts');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data (query params or body).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the GetResponse API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection or API errors.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('GetResponse API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Auth-Token' => 'api-key ' . $this->apiKey,
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("GetResponse API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("GetResponse API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('message') ?? $response->json('errorDescription') ?? $body;
                Log::error("GetResponse API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("GetResponse API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("GetResponse API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to GetResponse API: {$e->getMessage()}");
        }
    }
}
