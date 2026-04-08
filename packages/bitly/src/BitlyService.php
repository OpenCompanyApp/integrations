<?php

namespace OpenCompany\Integrations\Bitly;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Bitly API service for link management.
 *
 * Handles authentication and HTTP communication with the Bitly v4 API.
 * Supports Bearer token authentication and provides methods for all
 * Bitly operations: shortening, creating, reading, updating links,
 * retrieving click analytics, and managing groups.
 */
class BitlyService
{
    /**
     * Create a new BitlyService instance.
     *
     * @param string $accessToken Bitly OAuth access token
     * @param string $baseUrl     Bitly API base URL
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api-ssl.bitly.com/v4',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     *
     * @return bool True if an access token is set
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Shorten a long URL into a Bitlink.
     *
     * @param string      $longUrl   The long URL to shorten
     * @param string|null $domain    Custom domain (e.g., "bit.ly")
     * @param string|null $groupGuid Group GUID to associate the link with
     *
     * @return array The shortened link data from Bitly
     *
     * @throws \RuntimeException If the request fails
     */
    public function shortenLink(string $longUrl, ?string $domain = null, ?string $groupGuid = null): array
    {
        $data = ['long_url' => $longUrl];
        if ($domain !== null) {
            $data['domain'] = $domain;
        }
        if ($groupGuid !== null) {
            $data['group_guid'] = $groupGuid;
        }

        return $this->request('POST', '/shorten', $data);
    }

    /**
     * Retrieve a Bitlink by its identifier.
     *
     * @param string $bitlink The Bitlink identifier (e.g., "bit.ly/abc123")
     *
     * @return array The Bitlink data
     *
     * @throws \RuntimeException If the request fails
     */
    public function getLink(string $bitlink): array
    {
        return $this->request('GET', '/bitlinks/' . urlencode($bitlink));
    }

    /**
     * Update a Bitlink's metadata.
     *
     * @param string     $bitlink The Bitlink identifier (e.g., "bit.ly/abc123")
     * @param array      $data    Fields to update (title, archived, tags, etc.)
     *
     * @return array The updated Bitlink data
     *
     * @throws \RuntimeException If the request fails
     */
    public function updateLink(string $bitlink, array $data): array
    {
        return $this->request('PATCH', '/bitlinks/' . urlencode($bitlink), $data);
    }

    /**
     * Get click metrics for a Bitlink.
     *
     * @param string      $bitlink        The Bitlink identifier (e.g., "bit.ly/abc123")
     * @param string|null $unit           Time unit: "minute", "hour", "day", "week", "month"
     * @param int|null    $units          Number of units to return (-1 for all)
     * @param string|null $unitReference  ISO timestamp for the reference point
     *
     * @return array Click metrics data
     *
     * @throws \RuntimeException If the request fails
     */
    public function getClicks(string $bitlink, ?string $unit = null, ?int $units = null, ?string $unitReference = null): array
    {
        $params = [];
        if ($unit !== null) {
            $params['unit'] = $unit;
        }
        if ($units !== null) {
            $params['units'] = $units;
        }
        if ($unitReference !== null) {
            $params['unit_reference'] = $unitReference;
        }

        return $this->request('GET', '/bitlinks/' . urlencode($bitlink) . '/clicks', $params);
    }

    /**
     * List all groups in the Bitly account.
     *
     * @return array List of groups
     *
     * @throws \RuntimeException If the request fails
     */
    public function listGroups(): array
    {
        return $this->request('GET', '/groups');
    }

    /**
     * Retrieve a specific group by its GUID.
     *
     * @param string $groupGuid The group GUID
     *
     * @return array The group data
     *
     * @throws \RuntimeException If the request fails
     */
    public function getGroup(string $groupGuid): array
    {
        return $this->request('GET', '/groups/' . urlencode($groupGuid));
    }

    /**
     * Create a new Bitlink with full metadata.
     *
     * @param string        $longUrl The destination URL
     * @param string|null   $title   A descriptive title for the link
     * @param array|null    $tags    Array of tags to apply
     * @param string|null   $domain  Custom short domain (e.g., "bit.ly")
     * @param string|null   $groupGuid Group GUID to associate the link with
     *
     * @return array The created Bitlink data
     *
     * @throws \RuntimeException If the request fails
     */
    public function createBitlink(string $longUrl, ?string $title = null, ?array $tags = null, ?string $domain = null, ?string $groupGuid = null): array
    {
        $data = ['long_url' => $longUrl];
        if ($title !== null) {
            $data['title'] = $title;
        }
        if ($tags !== null) {
            $data['tags'] = $tags;
        }
        if ($domain !== null) {
            $data['domain'] = $domain;
        }
        if ($groupGuid !== null) {
            $data['group_guid'] = $groupGuid;
        }

        return $this->request('POST', '/bitlinks', $data);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array The user profile data
     *
     * @throws \RuntimeException If the request fails
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PATCH, PUT, DELETE)
     * @param string $path   API path (e.g., "/shorten")
     * @param array  $data   Request payload or query parameters
     *
     * @return array Parsed JSON response body
     *
     * @throws \RuntimeException If the request fails
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        $body = $response->body();
        if (empty($body)) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Bitly API.
     *
     * @param string $method HTTP method
     * @param string $path   API path
     * @param array  $data   Request payload or query parameters
     *
     * @return \Illuminate\Http\Client\Response The raw HTTP response
     *
     * @throws \RuntimeException If not configured or request fails
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Bitly access token is not configured.');
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
                'PATCH' => $http->patch($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('description') ?? $response->body();
                Log::error("Bitly API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Bitly API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Bitly API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Bitly API: {$e->getMessage()}");
        }
    }
}
