<?php

namespace OpenCompany\Integrations\Apollo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Apollo.io API service for contacts, organizations, and user data.
 *
 * Handles authentication via Bearer token and provides methods for all
 * Apollo API endpoints used by the integration tools.
 */
class ApolloService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.apollo.io',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Search for contacts (mixed people search).
     *
     * @param  string  $q  Search query (name, email, or keyword).
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Results per page.
     * @return array<string, mixed> API response data.
     */
    public function searchContacts(string $q, int $page = 1, int $perPage = 25): array
    {
        return $this->request('POST', '/api/v1/mixed_people/search', [
            'q' => $q,
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a single contact by Apollo person ID.
     *
     * @param  string  $id  The Apollo person ID.
     * @return array<string, mixed> API response data.
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', '/api/v1/people/' . urlencode($id));
    }

    /**
     * Enrich a contact by matching on email and/or name.
     *
     * @param  string|null  $email  Email address to match.
     * @param  string|null  $name  Full name to match.
     * @return array<string, mixed> API response data.
     */
    public function enrich(?string $email = null, ?string $name = null): array
    {
        $body = [];
        if ($email !== null) {
            $body['email'] = $email;
        }
        if ($name !== null) {
            $body['name'] = $name;
        }

        return $this->request('POST', '/api/v1/people/match', $body);
    }

    /**
     * List organizations with pagination.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Results per page.
     * @return array<string, mixed> API response data.
     */
    public function listOrganizations(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', '/api/v1/organizations', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a single organization by Apollo organization ID.
     *
     * @param  string  $id  The Apollo organization ID.
     * @return array<string, mixed> API response data.
     */
    public function getOrganization(string $id): array
    {
        return $this->request('GET', '/api/v1/organizations/' . urlencode($id));
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed> API response data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Apollo API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request payload.
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException When the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Apollo API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Cache-Control' => 'no-cache',
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
                    Log::warning("Apollo API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Apollo API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be experiencing issues.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Apollo API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Apollo API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Apollo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Apollo API: {$e->getMessage()}");
        }
    }
}
