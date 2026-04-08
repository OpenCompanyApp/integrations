<?php

namespace OpenCompany\Integrations\Freshmarketer;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * FreshmarketerService — HTTP client for the Freshmarketer (Freshworks) API.
 *
 * Handles authentication via Bearer token, configurable base URL per domain,
 * and provides methods for campaigns, segments, and users.
 */
class FreshmarketerService
{
    public function __construct(
        private string $accessToken = '',
        private string $domain = '',
        private string $baseUrl = '',
    ) {
        // Build base URL from domain if no explicit base URL provided
        if (empty($this->baseUrl) && !empty($this->domain)) {
            $this->baseUrl = "https://{$this->domain}.myfreshworks.com/crm/sales";
        }

        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->baseUrl);
    }

    /**
     * List campaigns with optional pagination and status filter.
     *
     * @param  int  $page   Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @param  string|null  $status  Filter by campaign status (e.g., "active", "completed").
     * @return array<string, mixed>
     */
    public function listCampaigns(int $page = 1, int $limit = 20, ?string $status = null): array
    {
        $data = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($status !== null) {
            $data['status'] = $status;
        }

        return $this->request('POST', '/api/v1/campaigns', $data);
    }

    /**
     * Get details for a single campaign by ID.
     *
     * @param  int|string  $id  The campaign identifier.
     * @return array<string, mixed>
     */
    public function getCampaign(int|string $id): array
    {
        return $this->request('POST', '/api/v1/campaigns/' . urlencode((string) $id));
    }

    /**
     * Create a new campaign.
     *
     * @param  string  $name         Campaign name.
     * @param  array  $channelList   List of channels (e.g., ["email"]).
     * @param  array|null  $schedule  Optional schedule configuration.
     * @return array<string, mixed>
     */
    public function createCampaign(string $name, array $channelList = [], ?array $schedule = null): array
    {
        $data = [
            'name' => $name,
            'channel_list' => $channelList,
        ];

        if ($schedule !== null) {
            $data['schedule'] = $schedule;
        }

        return $this->request('POST', '/api/v1/campaigns', $data);
    }

    /**
     * List segments with optional pagination.
     *
     * @param  int  $page   Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @return array<string, mixed>
     */
    public function listSegments(int $page = 1, int $limit = 20): array
    {
        return $this->request('POST', '/api/v1/segments', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get details for a single segment by ID.
     *
     * @param  int|string  $id  The segment identifier.
     * @return array<string, mixed>
     */
    public function getSegment(int|string $id): array
    {
        return $this->request('GET', '/api/v1/segments/' . urlencode((string) $id));
    }

    /**
     * List users.
     *
     * @return array<string, mixed>
     */
    public function listUsers(): array
    {
        return $this->request('POST', '/api/v1/users');
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g., "/api/v1/campaigns").
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Freshmarketer API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When credentials are missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Freshmarketer access token is not configured.');
        }

        if (!$this->baseUrl) {
            throw new \RuntimeException('Freshmarketer domain/base URL is not configured.');
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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Freshmarketer API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Freshmarketer API endpoint not available (HTTP {$response->status()}). The domain or base URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Freshmarketer API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Freshmarketer API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Freshmarketer API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Freshmarketer API: {$e->getMessage()}");
        }
    }
}
