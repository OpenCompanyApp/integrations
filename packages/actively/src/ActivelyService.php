<?php

namespace OpenCompany\Integrations\Actively;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Actively API service — handles authentication and HTTP communication with the Actively CRM API.
 *
 * Supports Bearer token authentication and configurable base URL for self-hosted instances.
 * All methods return parsed JSON arrays unless otherwise noted.
 */
class ActivelyService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.actively.com',
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
     * List campaigns for an organization.
     *
     * @param  string  $orgId  The organization UUID.
     * @param  int  $limit  Maximum number of campaigns to return (default: 25).
     * @param  int  $page  Page number for pagination (default: 1).
     * @return array<string, mixed> The API response containing campaigns data.
     */
    public function listCampaigns(string $orgId, int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', "/v1/organizations/{$orgId}/campaigns", [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single campaign by ID.
     *
     * @param  string  $orgId  The organization UUID.
     * @param  string  $campaignId  The campaign UUID.
     * @return array<string, mixed> The campaign data.
     */
    public function getCampaign(string $orgId, string $campaignId): array
    {
        return $this->request('GET', "/v1/organizations/{$orgId}/campaigns/{$campaignId}");
    }

    /**
     * Create a new campaign for an organization.
     *
     * @param  string  $orgId  The organization UUID.
     * @param  string  $title  The campaign title.
     * @param  string  $type  The campaign type (e.g., "email", "social", "ads").
     * @param  string  $startDate  Campaign start date (ISO 8601, e.g., "2026-01-01").
     * @param  string  $endDate  Campaign end date (ISO 8601, e.g., "2026-03-31").
     * @return array<string, mixed> The created campaign data.
     */
    public function createCampaign(string $orgId, string $title, string $type, string $startDate, string $endDate): array
    {
        return $this->request('POST', "/v1/organizations/{$orgId}/campaigns", [
            'title' => $title,
            'type' => $type,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }

    /**
     * List contacts for an organization.
     *
     * @param  string  $orgId  The organization UUID.
     * @param  int  $limit  Maximum number of contacts to return (default: 25).
     * @param  int  $page  Page number for pagination (default: 1).
     * @return array<string, mixed> The API response containing contacts data.
     */
    public function listContacts(string $orgId, int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', "/v1/organizations/{$orgId}/contacts", [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  string  $orgId  The organization UUID.
     * @param  string  $contactId  The contact UUID.
     * @return array<string, mixed> The contact data.
     */
    public function getContact(string $orgId, string $contactId): array
    {
        return $this->request('GET', "/v1/organizations/{$orgId}/contacts/{$contactId}");
    }

    /**
     * List organizations the authenticated user has access to.
     *
     * @param  int  $limit  Maximum number of organizations to return (default: 25).
     * @param  int  $page  Page number for pagination (default: 1).
     * @return array<string, mixed> The API response containing organizations data.
     */
    public function listOrganizations(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/v1/organizations', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed> The user profile data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., "/v1/organizations").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Actively API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When the API key is missing, connection fails, or the response indicates an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Actively access token is not configured.');
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Actively API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Actively API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is down.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Actively API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Actively API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Actively API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Actively API: {$e->getMessage()}");
        }
    }
}
