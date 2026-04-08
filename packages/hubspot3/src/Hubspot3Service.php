<?php

namespace OpenCompany\Integrations\Hubspot3;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the HubSpot REST API v1 covering contacts, companies, and deals.
 *
 * Wraps the HubSpot CRM API with Bearer token authentication, request routing, and error reporting.
 */
class Hubspot3Service
{
    /**
     * @param  string  $accessToken  HubSpot OAuth 2.0 or Private App access token
     * @param  string  $baseUrl      HubSpot API base URL (default: https://api.hubapi.com/v1)
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.hubapi.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Contacts ──────────────────────────────────────────

    /**
     * List contacts.
     *
     * @param  array<string, mixed>  $params  Query params: limit, offset, properties, etc.
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts/v1/lists/all/contacts/all', $params);
    }

    /**
     * Get a contact by ID.
     *
     * @return array<string, mixed>
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', "/contacts/v1/contact/vid/{$id}/profile");
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact payload
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts/v1/contact', $data);
    }

    // ── Companies ─────────────────────────────────────────

    /**
     * List companies.
     *
     * @param  array<string, mixed>  $params  Query params: limit, offset, properties, etc.
     * @return array<string, mixed>
     */
    public function listCompanies(array $params = []): array
    {
        return $this->request('GET', '/companies/v2/companies/paged', $params);
    }

    /**
     * Get a company by ID.
     *
     * @return array<string, mixed>
     */
    public function getCompany(string $id): array
    {
        return $this->request('GET', "/companies/v2/companies/{$id}");
    }

    // ── Deals ─────────────────────────────────────────────

    /**
     * List deals.
     *
     * @param  array<string, mixed>  $params  Query params: limit, offset, properties, etc.
     * @return array<string, mixed>
     */
    public function listDeals(array $params = []): array
    {
        return $this->request('GET', '/deals/v1/deal/paged', $params);
    }

    // ── Me (current user) ─────────────────────────────────

    /**
     * Get the current authenticated user's information.
     *
     * @return array<string, mixed>
     */
    public function getMe(): array
    {
        return $this->request('GET', '/integrations/v1/me');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST/PUT/DELETE)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('HubSpot access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['message'] ?? $body['error'] ?? $response->body();

                Log::error("HubSpot API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => is_string($err) ? $err : json_encode($err),
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('HubSpot API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("HubSpot API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to HubSpot API: {$e->getMessage()}");
        }
    }
}
