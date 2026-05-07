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
     * Get a click summary for a Bitlink.
     *
     * @param  string  $bitlink  The Bitlink identifier.
     * @param  array<string, mixed>  $params  Query parameters such as unit, units, and unit_reference.
     * @return array<string, mixed>
     */
    public function getClickSummary(string $bitlink, array $params = []): array
    {
        return $this->request('GET', '/bitlinks/' . urlencode($bitlink) . '/clicks/summary', $params);
    }

    /**
     * Get click counts grouped by country for a Bitlink.
     *
     * @param  string  $bitlink  The Bitlink identifier.
     * @param  array<string, mixed>  $params  Query parameters such as unit, units, size, and unit_reference.
     * @return array<string, mixed>
     */
    public function getClickCountries(string $bitlink, array $params = []): array
    {
        return $this->request('GET', '/bitlinks/' . urlencode($bitlink) . '/countries', $params);
    }

    /**
     * Get click counts grouped by referrer for a Bitlink.
     *
     * @param  string  $bitlink  The Bitlink identifier.
     * @param  array<string, mixed>  $params  Query parameters such as unit, units, size, and unit_reference.
     * @return array<string, mixed>
     */
    public function getClickReferrers(string $bitlink, array $params = []): array
    {
        return $this->request('GET', '/bitlinks/' . urlencode($bitlink) . '/referrers', $params);
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
     * List Bitlinks in a group.
     *
     * @param  string  $groupGuid  The group GUID.
     * @param  array<string, mixed>  $params  Query parameters such as size, page, keyword, query, and archived.
     * @return array<string, mixed>
     */
    public function listGroupBitlinks(string $groupGuid, array $params = []): array
    {
        return $this->request('GET', '/groups/' . urlencode($groupGuid) . '/bitlinks', $params);
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
     * Expand a short Bitlink to its long URL.
     *
     * @param  string  $bitlink  Bitlink identifier.
     * @return array<string, mixed>
     */
    public function expandBitlink(string $bitlink): array
    {
        return $this->request('POST', '/expand', ['bitlink_id' => $bitlink]);
    }

    /**
     * Add a custom back-half to an existing Bitlink.
     *
     * @param  string  $customBitlink  Custom Bitlink, such as links.example.test/campaign.
     * @param  string  $bitlinkId  Existing Bitlink ID.
     * @return array<string, mixed>
     */
    public function addCustomBitlink(string $customBitlink, string $bitlinkId): array
    {
        return $this->request('POST', '/custom_bitlinks', [
            'custom_bitlink' => $customBitlink,
            'bitlink_id' => $bitlinkId,
        ]);
    }

    /**
     * Create a Bitly QR Code.
     *
     * @param  array<string, mixed>  $body  QR Code body.
     * @return array<string, mixed>
     */
    public function createQrCode(array $body): array
    {
        return $this->request('POST', '/qr-codes', $body);
    }

    /**
     * Get a Bitly QR Code by ID.
     *
     * @param  string  $qrCodeId  QR Code ID.
     * @return array<string, mixed>
     */
    public function getQrCode(string $qrCodeId): array
    {
        return $this->request('GET', '/qr-codes/' . urlencode($qrCodeId));
    }

    /**
     * List webhooks for an organization.
     *
     * @param  string  $organizationGuid  Organization GUID.
     * @return array<string, mixed>
     */
    public function listOrganizationWebhooks(string $organizationGuid): array
    {
        return $this->request('GET', '/organizations/' . urlencode($organizationGuid) . '/webhooks');
    }

    /**
     * Create a webhook for an organization.
     *
     * @param  string  $organizationGuid  Organization GUID.
     * @param  array<string, mixed>  $body  Webhook body.
     * @return array<string, mixed>
     */
    public function createOrganizationWebhook(string $organizationGuid, array $body): array
    {
        return $this->request('POST', '/organizations/' . urlencode($organizationGuid) . '/webhooks', $body);
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
     * Call any Bitly GET API endpoint.
     *
     * @param  string  $path  API path relative to the v4 base URL.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Call any Bitly POST API endpoint.
     *
     * @param  string  $path  API path relative to the v4 base URL.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $body);
    }

    /**
     * Call any Bitly PATCH API endpoint.
     *
     * @param  string  $path  API path relative to the v4 base URL.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $body = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $body);
    }

    /**
     * Call any Bitly DELETE API endpoint.
     *
     * @param  string  $path  API path relative to the v4 base URL.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $body);
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

    /**
     * Normalize a generic API path.
     */
    private function normalizePath(string $path): string
    {
        return '/'.ltrim($path, '/');
    }
}
