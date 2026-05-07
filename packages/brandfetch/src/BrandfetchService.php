<?php

namespace OpenCompany\Integrations\Brandfetch;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Brandfetch APIs.
 *
 * Handles Brand API bearer authentication, Brand Search client IDs, Logo CDN
 * URL construction, response parsing, and safe relative endpoint access.
 */
class BrandfetchService
{
    /**
     * @param  string  $accessToken  Brand API bearer token.
     * @param  string  $baseUrl  Base URL for Brandfetch API requests.
     * @param  string  $clientId  Brand Search and Logo API client ID.
     * @param  string  $cdnUrl  Base URL for Logo API CDN links.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.brandfetch.io',
        private string $clientId = '',
        private string $cdnUrl = 'https://cdn.brandfetch.io',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->cdnUrl = rtrim($this->cdnUrl, '/');
    }

    /**
     * Check whether the service has either Brand API or client-ID credentials.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '' || $this->clientId !== '';
    }

    /**
     * Get brand data by generic identifier.
     *
     * @param  string  $identifier  Domain, Brand ID, ticker, ISIN, or crypto symbol.
     * @return array<string, mixed>
     */
    public function getBrand(string $identifier): array
    {
        return $this->apiGet('/v2/brands/' . rawurlencode($identifier));
    }

    /**
     * Get brand data using an explicit identifier type.
     *
     * @param  string  $type  One of domain, ticker, isin, or crypto.
     * @param  string  $identifier  Identifier value.
     * @return array<string, mixed>
     */
    public function getBrandByType(string $type, string $identifier): array
    {
        $allowed = ['domain', 'ticker', 'isin', 'crypto'];

        if (!in_array($type, $allowed, true)) {
            throw new \InvalidArgumentException('type must be one of: ' . implode(', ', $allowed));
        }

        return $this->apiGet('/v2/brands/' . $type . '/' . rawurlencode($identifier));
    }

    /**
     * Search for brands by name or domain with the Brand Search API.
     *
     * @param  string  $query  Brand name or domain.
     * @param  string|null  $clientId  Optional client ID override.
     * @return array<string, mixed>
     */
    public function searchBrands(string $query, ?string $clientId = null): array
    {
        $clientId ??= $this->clientId;

        if ($clientId === '') {
            throw new \RuntimeException('Brandfetch client ID is required for Brand Search API.');
        }

        return $this->request('GET', '/v2/search/' . rawurlencode($query), ['c' => $clientId], [], false);
    }

    /**
     * Get brand data from a raw payment transaction label.
     *
     * @param  array<string, mixed>  $payload  Transaction payload with transactionLabel and countryCode.
     * @return array<string, mixed>
     */
    public function enrichTransaction(array $payload): array
    {
        return $this->apiPost('/v2/brands/transaction', $payload);
    }

    /**
     * Build a Logo API CDN URL for direct embedding.
     *
     * @param  string  $identifier  Domain, brand ID, ticker, ISIN, or crypto symbol.
     * @param  array<string, mixed>  $options  Width, height, theme, fallback, type, format, or c/client_id.
     * @return array<string, mixed>
     */
    public function logoUrl(string $identifier, array $options = []): array
    {
        $clientId = (string) ($options['client_id'] ?? $options['c'] ?? $this->clientId);

        if ($clientId === '') {
            throw new \RuntimeException('Brandfetch client ID is required for Logo API URLs.');
        }

        $path = rawurlencode($identifier);
        $segments = [
            'w' => 'width',
            'h' => 'height',
            'theme' => 'theme',
            'fallback' => 'fallback',
            'type' => 'type',
            'format' => 'format',
        ];

        foreach ($segments as $segment => $key) {
            if (($options[$key] ?? null) !== null && $options[$key] !== '') {
                $path .= '/' . $segment . '/' . rawurlencode((string) $options[$key]);
            }
        }

        $url = $this->cdnUrl . '/' . $path . '?' . http_build_query(['c' => $clientId]);

        return [
            'url' => $url,
            'identifier' => $identifier,
            'client_id' => $clientId,
        ];
    }

    /**
     * Backwards-compatible helper returning logos from a brand payload.
     *
     * @return array<string, mixed>
     */
    public function listLogos(string $identifier): array
    {
        $brand = $this->getBrand($identifier);

        return ['logos' => $brand['logos'] ?? [], 'brand' => $brand];
    }

    /**
     * Backwards-compatible helper returning a logo format by URL.
     *
     * @return array<string, mixed>
     */
    public function getLogo(string $src): array
    {
        return ['src' => $src];
    }

    /**
     * Backwards-compatible helper returning colors from a brand payload.
     *
     * @return array<string, mixed>
     */
    public function listColors(string $identifier): array
    {
        $brand = $this->getBrand($identifier);

        return ['colors' => $brand['colors'] ?? [], 'brand' => $brand];
    }

    /**
     * Backwards-compatible helper returning fonts from a brand payload.
     *
     * @return array<string, mixed>
     */
    public function listFonts(string $identifier): array
    {
        $brand = $this->getBrand($identifier);

        return ['fonts' => $brand['fonts'] ?? [], 'brand' => $brand];
    }

    /**
     * Verify credentials by fetching Brandfetch's own free test brand.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->getBrand('brandfetch.com');
    }

    /**
     * Execute a safe relative GET request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Execute a safe relative POST request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, $query, $body);
    }

    /**
     * Execute a safe relative request and parse JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  bool  $requiresBearer  Whether a bearer token is required.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = [], bool $requiresBearer = true): array
    {
        $response = $this->rawRequest($method, $path, $query, $body, $requiresBearer);

        if (trim($response->body()) === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        $json = $response->json();

        return is_array($json) ? $json : [];
    }

    /**
     * Execute an authenticated raw HTTP request.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  bool  $requiresBearer  Whether a bearer token is required.
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = [], bool $requiresBearer = true): Response
    {
        if ($requiresBearer && $this->accessToken === '') {
            throw new \RuntimeException('Brandfetch access token is not configured.');
        }

        $url = $this->url($this->safePath($path), $query);

        try {
            $headers = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ];

            if ($this->accessToken !== '') {
                $headers['Authorization'] = 'Bearer ' . $this->accessToken;
            }

            $http = Http::withHeaders($headers)->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Brandfetch API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Brandfetch API: {$e->getMessage()}");
        }
    }

    /**
     * Validate and normalize a relative API path.
     */
    private function safePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || preg_match('#^[a-z][a-z0-9+.-]*://#i', $path) || str_starts_with($path, '//') || str_contains($path, '..')) {
            throw new \InvalidArgumentException('Path must be a safe relative Brandfetch API path.');
        }

        return '/' . ltrim($path, '/');
    }

    /**
     * Build an absolute API URL.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function url(string $path, array $query = []): string
    {
        $query = array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== '');

        if ($query === []) {
            return $this->baseUrl . $path;
        }

        return $this->baseUrl . $path . '?' . http_build_query($query);
    }

    /**
     * Parse and throw a normalized API error.
     *
     * @throws \RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type') ?? '';
        $body = $response->body();

        if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Brandfetch API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new \RuntimeException("Brandfetch API returned unexpected HTML (HTTP {$response->status()}).");
        }

        $error = $response->json('error') ?? $response->json('message') ?? $body;

        Log::error("Brandfetch API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new \RuntimeException("Brandfetch API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
