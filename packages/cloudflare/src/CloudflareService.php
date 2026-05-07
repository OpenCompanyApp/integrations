<?php

namespace OpenCompany\Integrations\Cloudflare;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Cloudflare API v4.
 *
 * Handles bearer-token authentication, JSON request dispatch, Cloudflare error
 * normalization, and endpoint helpers used by individual tools.
 */
class CloudflareService
{
    /**
     * @param  string  $accessToken  Cloudflare API token.
     * @param  string  $baseUrl  Cloudflare API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.cloudflare.com/client/v4',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Execute a raw GET request against the Cloudflare API.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $query);
    }

    /**
     * Execute a raw POST request against the Cloudflare API.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw PATCH request against the Cloudflare API.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw PUT request against the Cloudflare API.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw DELETE request against the Cloudflare API.
     *
     * @param  array<string, mixed>  $payload  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * List all zones.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., name, status, page, per_page).
     * @return array<string, mixed>
     */
    public function listZones(array $params = []): array
    {
        return $this->request('GET', '/zones', $params);
    }

    /**
     * Get details for a specific zone.
     *
     * @param  string  $zoneId  The zone identifier.
     * @return array<string, mixed>
     */
    public function getZone(string $zoneId): array
    {
        return $this->request('GET', '/zones/' . urlencode($zoneId));
    }

    /**
     * List DNS records for a zone.
     *
     * @param  string  $zoneId  The zone identifier.
     * @param  array<string, mixed>  $params  Query parameters (e.g., type, name, page, per_page).
     * @return array<string, mixed>
     */
    public function listDnsRecords(string $zoneId, array $params = []): array
    {
        return $this->request('GET', '/zones/' . urlencode($zoneId) . '/dns_records', $params);
    }

    /**
     * Create a DNS record in a zone.
     *
     * @param  string  $zoneId  The zone identifier.
     * @param  array<string, mixed>  $data  DNS record data (type, name, content, ttl, proxied).
     * @return array<string, mixed>
     */
    public function createDnsRecord(string $zoneId, array $data): array
    {
        return $this->request('POST', '/zones/' . urlencode($zoneId) . '/dns_records', $data);
    }

    /**
     * Get a DNS record.
     *
     * @param  string  $zoneId  The zone identifier.
     * @param  string  $dnsRecordId  DNS record identifier.
     * @return array<string, mixed>
     */
    public function getDnsRecord(string $zoneId, string $dnsRecordId): array
    {
        return $this->request('GET', '/zones/' . urlencode($zoneId) . '/dns_records/' . urlencode($dnsRecordId));
    }

    /**
     * Update a DNS record, replacing the record object.
     *
     * @param  string  $zoneId  The zone identifier.
     * @param  string  $dnsRecordId  DNS record identifier.
     * @param  array<string, mixed>  $data  DNS record data.
     * @return array<string, mixed>
     */
    public function updateDnsRecord(string $zoneId, string $dnsRecordId, array $data): array
    {
        return $this->request('PUT', '/zones/' . urlencode($zoneId) . '/dns_records/' . urlencode($dnsRecordId), $data);
    }

    /**
     * Patch a DNS record.
     *
     * @param  string  $zoneId  The zone identifier.
     * @param  string  $dnsRecordId  DNS record identifier.
     * @param  array<string, mixed>  $data  DNS record fields to update.
     * @return array<string, mixed>
     */
    public function patchDnsRecord(string $zoneId, string $dnsRecordId, array $data): array
    {
        return $this->request('PATCH', '/zones/' . urlencode($zoneId) . '/dns_records/' . urlencode($dnsRecordId), $data);
    }

    /**
     * Delete a DNS record.
     *
     * @param  string  $zoneId  The zone identifier.
     * @param  string  $dnsRecordId  DNS record identifier.
     * @return array<string, mixed>
     */
    public function deleteDnsRecord(string $zoneId, string $dnsRecordId): array
    {
        return $this->request('DELETE', '/zones/' . urlencode($zoneId) . '/dns_records/' . urlencode($dnsRecordId));
    }

    /**
     * List page rules for a zone.
     *
     * @param  string  $zoneId  The zone identifier.
     * @param  array<string, mixed>  $params  Query parameters (e.g., status, page, per_page).
     * @return array<string, mixed>
     */
    public function listPageRules(string $zoneId, array $params = []): array
    {
        return $this->request('GET', '/zones/' . urlencode($zoneId) . '/pagerules', $params);
    }

    /**
     * Get analytics (dashboard) for a zone.
     *
     * @param  string  $zoneId  The zone identifier.
     * @param  string  $since  Start time (ISO 8601 or relative, e.g., "-30d").
     * @param  string  $until  End time (ISO 8601 or "now").
     * @param  string  $continuous  Whether to include continuous data ("true" or "false").
     * @return array<string, mixed>
     */
    public function getAnalytics(string $zoneId, string $since = '-30d', string $until = 'now', string $continuous = 'true'): array
    {
        return $this->request('GET', '/zones/' . urlencode($zoneId) . '/analytics/dashboard', [
            'since' => $since,
            'until' => $until,
            'continuous' => $continuous,
        ]);
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
     * @param  string  $method  HTTP method (GET, POST, PATCH, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for writes).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        $json = $response->json();

        if (!is_array($json)) {
            return [];
        }

        return $json;
    }

    /**
     * Normalize a user-supplied API path to a relative Cloudflare v4 path.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '') {
            throw new \RuntimeException('Cloudflare API path is required.');
        }

        $base = $this->baseUrl;
        if (str_starts_with($path, $base)) {
            $path = substr($path, strlen($base));
        }

        return '/' . ltrim($path, '/');
    }

    /**
     * Make a raw HTTP request to the Cloudflare API.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Cloudflare access token is not configured.');
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Cloudflare API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Cloudflare API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $json = $response->json();
                $errors = $json['errors'] ?? [];
                $errorMessages = array_map(fn (array $e) => ($e['code'] ?? 0) . ': ' . ($e['message'] ?? 'Unknown error'), $errors);
                $error = !empty($errorMessages) ? implode('; ', $errorMessages) : $body;

                Log::error("Cloudflare API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Cloudflare API error ({$response->status()}): {$error}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Cloudflare API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Cloudflare API: {$e->getMessage()}");
        }
    }
}
