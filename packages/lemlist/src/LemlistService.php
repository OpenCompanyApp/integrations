<?php

namespace OpenCompany\Integrations\Lemlist;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Lemlist API service — handles HTTP communication with the Lemlist REST API.
 *
 * Uses HTTP Basic authentication (username:password). The username is the Lemlist
 * account email and the password is the API key or account password.
 *
 * @see https://developer.lemlist.com/
 */
class LemlistService
{
    /**
     * Create a new LemlistService instance.
     *
     * @param  string  $username  Lemlist account email or API username.
     * @param  string  $password  Lemlist API key or account password.
     * @param  string  $baseUrl   Lemlist API base URL.
     */
    public function __construct(
        private string $username = '',
        private string $password = '',
        private string $baseUrl = 'https://api.lemlist.com/api',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->username) && !empty($this->password);
    }

    /**
     * List all campaigns.
     *
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. status, limit, offset).
     * @return array<string, mixed>
     */
    public function listCampaigns(array $params = []): array
    {
        return $this->request('GET', '/campaigns', $params);
    }

    /**
     * Get a single campaign by ID.
     *
     * @param  string  $id  The campaign ID.
     * @return array<string, mixed>
     */
    public function getCampaign(string $id): array
    {
        return $this->request('GET', '/campaigns/' . urlencode($id));
    }

    /**
     * List leads in a campaign.
     *
     * @param  string  $campaignId  The campaign ID.
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. status, limit, offset).
     * @return array<string, mixed>
     */
    public function listLeads(string $campaignId, array $params = []): array
    {
        return $this->request('GET', '/campaigns/' . urlencode($campaignId) . '/leads', $params);
    }

    /**
     * Add a lead to a campaign.
     *
     * @param  string  $campaignId  The campaign ID to add the lead to.
     * @param  array<string, mixed>  $leadData  Lead data (e.g. email, firstName, lastName, companyName, etc.).
     * @return array<string, mixed>
     */
    public function addLead(string $campaignId, array $leadData): array
    {
        return $this->request('POST', '/campaigns/' . urlencode($campaignId) . '/leads', $leadData);
    }

    /**
     * List all teams.
     *
     * @return array<string, mixed>
     */
    public function listTeams(): array
    {
        return $this->request('GET', '/teams');
    }

    /**
     * List all sub-accounts.
     *
     * @return array<string, mixed>
     */
    public function listSubaccounts(): array
    {
        return $this->request('GET', '/subaccounts');
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Lemlist API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Lemlist credentials are not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->username, $this->password)
                ->withHeaders(['Content-Type' => 'application/json'])
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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Lemlist API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Lemlist API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be down.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Lemlist API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Lemlist API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Lemlist API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Lemlist API: {$e->getMessage()}");
        }
    }
}
