<?php

namespace OpenCompany\Integrations\Clearbit;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for Clearbit enrichment, reveal, prospector, discovery, and legacy free APIs.
 *
 * Clearbit routes product families through separate API hosts, so this client
 * keeps endpoint-specific base URLs instead of assuming one host for everything.
 */
class ClearbitService
{
    /**
     * @var array<string, string>
     */
    private array $baseUrls;

    /**
     * Create a new Clearbit service instance.
     *
     * @param  string  $apiKey  Bearer token for Clearbit API authentication.
     * @param  string  $baseUrl  Backward-compatible person API base URL.
     * @param  array<string, string>  $baseUrls  Optional endpoint-specific base URL overrides.
     */
    public function __construct(
        private string $apiKey = '',
        string $baseUrl = 'https://person.clearbit.com/v2',
        array $baseUrls = [],
    ) {
        $defaults = [
            'person' => rtrim($baseUrl, '/'),
            'company' => 'https://company.clearbit.com/v2',
            'autocomplete' => 'https://autocomplete.clearbit.com/v1',
            'prospector' => 'https://prospector.clearbit.com/v1',
            'reveal' => 'https://reveal.clearbit.com/v1',
            'discovery' => 'https://discovery.clearbit.com/v1',
            'risk' => 'https://risk.clearbit.com/v1',
            'name_to_domain' => 'https://company.clearbit.com/v1',
        ];

        $this->baseUrls = array_map(
            static fn (string $url): string => rtrim($url, '/'),
            array_merge($defaults, $baseUrls),
        );
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Enrich a person by email address.
     *
     * Looks up a person's social, employment, and demographic data using their email.
     *
     * @param  string  $email  The email address to look up.
     * @return array<string, mixed> The enriched person record.
     *
     * @see https://clearbit.com/docs#enrichment-api-person-api
     */
    public function enrichPerson(string $email): array
    {
        return $this->request('person', 'GET', '/people/find', ['email' => $email]);
    }

    /**
     * Enrich a person and their company by email address.
     *
     * @param  string  $email  The email address to look up.
     * @return array<string, mixed> The combined person and company result.
     *
     * @see https://pkg.go.dev/github.com/clearbit/clearbit-go/clearbit#PersonService.FindCombined
     */
    public function enrichCombined(string $email): array
    {
        return $this->request('person', 'GET', '/combined/find', ['email' => $email]);
    }

    /**
     * Enrich a company by domain name.
     *
     * Retrieves company metrics, categorization, and social profiles from a domain.
     *
     * @param  string  $domain  The company domain.
     * @return array<string, mixed> The enriched company record.
     *
     * @see https://clearbit.com/docs#enrichment-api-company-api
     */
    public function enrichCompany(string $domain): array
    {
        return $this->request('company', 'GET', '/companies/find', ['domain' => $domain]);
    }

    /**
     * Reveal visitor identity from an IP address.
     *
     * Maps an IP address to the associated company and person (when available).
     *
     * @param  string  $ip  The IPv4 or IPv6 address to look up.
     * @return array<string, mixed> The reveal result with company data.
     *
     * @see https://clearbit.com/docs#reveal-api
     */
    public function reveal(string $ip): array
    {
        return $this->request('reveal', 'GET', '/companies/find', ['ip' => $ip]);
    }

    /**
     * Prospect for people using Clearbit Prospector filters.
     *
     * @param  array<string, mixed>  $params  Query parameters such as domain, role, roles, seniority, title, page.
     * @return array<string, mixed> List of matching people.
     *
     * @see https://clearbit.com/docs#prospecting-api
     */
    public function prospect(array $params = []): array
    {
        if (isset($params['roles']) && is_string($params['roles'])) {
            $params['roles'] = array_values(array_filter(array_map('trim', explode(',', $params['roles']))));
        }

        return $this->request('prospector', 'GET', '/people/search', $params);
    }

    /**
     * Autocomplete company suggestions by name.
     *
     * Returns a list of companies matching the given name prefix, useful for
     * type-ahead / autocomplete UI flows.
     *
     * @param  string  $name  Company name or prefix to search for.
     * @return array<string, mixed> List of matching companies.
     *
     * @see https://clearbit.com/docs#autocomplete-api
     */
    public function autocomplete(string $name): array
    {
        return $this->request('autocomplete', 'GET', '/companies/suggest', ['query' => $name], authenticated: false);
    }

    /**
     * Find a company domain and logo by company name.
     *
     * @return array<string, mixed> The matched company domain result.
     *
     * @see https://clearbit.com/blog/company-name-to-domain-api
     */
    public function nameToDomain(string $name): array
    {
        return $this->request('name_to_domain', 'GET', '/domains/find', ['name' => $name], authMode: 'basic');
    }

    /**
     * Search companies with the Clearbit Discovery API.
     *
     * @param  array<string, mixed>  $params  Query parameters such as query, page, and limit.
     * @return array<string, mixed>
     */
    public function searchDiscovery(array $params): array
    {
        return $this->request('discovery', 'GET', '/companies/search', $params);
    }

    /**
     * Calculate a Clearbit Risk score.
     *
     * @param  array<string, mixed>  $params  Risk inputs such as email, ip, name, country_code, and zip_code.
     * @return array<string, mixed>
     */
    public function calculateRisk(array $params): array
    {
        return $this->request('risk', 'GET', '/calculate', $params);
    }

    /**
     * Call a read-only Clearbit API endpoint.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>|array<int, mixed>
     */
    public function apiGet(string $api, string $path, array $params = []): array
    {
        if (! isset($this->baseUrls[$api])) {
            throw new \RuntimeException('api must be one of: '.implode(', ', array_keys($this->baseUrls)).'.');
        }

        $path = '/'.ltrim($path, '/');

        if (str_starts_with($path, '//') || str_contains($path, '://')) {
            throw new \RuntimeException('path must be a Clearbit API path such as /companies/find.');
        }

        return $this->request($api, 'GET', $path, $params, authenticated: $api !== 'autocomplete');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., "/people/find").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $api, string $method, string $path, array $data = [], bool $authenticated = true, string $authMode = 'bearer'): array
    {
        $response = $this->rawRequest($api, $method, $path, $data, $authenticated, $authMode);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Clearbit API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing, the connection fails, or the API returns an error.
     */
    private function rawRequest(string $api, string $method, string $path, array $data = [], bool $authenticated = true, string $authMode = 'bearer'): \Illuminate\Http\Client\Response
    {
        if ($authenticated && !$this->apiKey) {
            throw new \RuntimeException('Clearbit API key is not configured.');
        }

        $url = $this->baseUrls[$api] . $path;

        try {
            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            if ($authenticated && $authMode === 'basic') {
                $headers['Authorization'] = 'Basic ' . base64_encode($this->apiKey . ':');
            } elseif ($authenticated) {
                $headers['Authorization'] = 'Bearer ' . $this->apiKey;
            }

            $http = Http::withHeaders($headers)->timeout(30);

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
                    Log::warning("Clearbit API returned HTML for {$method} {$api}:{$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Clearbit API endpoint not available (HTTP {$response->status()}). The {$api}:{$path} endpoint may not be available on your plan or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Clearbit API error: {$method} {$api}:{$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Clearbit API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Clearbit API connection error: {$method} {$api}:{$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Clearbit API: {$e->getMessage()}");
        }
    }
}
