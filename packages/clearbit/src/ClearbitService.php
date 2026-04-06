<?php

namespace OpenCompany\Integrations\Clearbit;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ClearbitService
{
    /**
     * Create a new Clearbit service instance.
     *
     * @param  string  $apiKey  Bearer token for Clearbit API authentication.
     * @param  string  $baseUrl  Base URL for the Clearbit API (default: https://person.clearbit.com/v2).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://person.clearbit.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
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
        return $this->request('GET', '/people/find', ['email' => $email]);
    }

    /**
     * Enrich a company by domain name.
     *
     * Retrieves company metrics, categorization, and social profiles from a domain.
     *
     * @param  string  $domain  The company domain (e.g., "stripe.com").
     * @return array<string, mixed> The enriched company record.
     *
     * @see https://clearbit.com/docs#enrichment-api-company-api
     */
    public function enrichCompany(string $domain): array
    {
        return $this->request('GET', '/companies/find', ['domain' => $domain]);
    }

    /**
     * Reveal visitor identity from an IP address.
     *
     * Maps an IP address to the associated company and person (when available).
     *
     * @param  string  $ip  The IPv4 or IPv6 address to look up.
     * @return array<string, mixed> The reveal result with company and person data.
     *
     * @see https://clearbit.com/docs#reveal-api
     */
    public function reveal(string $ip): array
    {
        return $this->request('GET', '/reveal', ['ip' => $ip]);
    }

    /**
     * Prospect for people by job title and/or company.
     *
     * Searches for people matching the given criteria. Results include names, titles,
     * and email addresses (when available).
     *
     * @param  string|null  $title  Job title to search for (e.g., "CEO", "Software Engineer").
     * @param  string|null  $company  Company name to filter by (e.g., "Stripe").
     * @param  int  $page  Page number for pagination (default: 1).
     * @return array<string, mixed> List of matching people.
     *
     * @see https://clearbit.com/docs#prospecting-api
     */
    public function prospect(?string $title = null, ?string $company = null, int $page = 1): array
    {
        $params = ['page' => $page];
        if ($title !== null) {
            $params['title'] = $title;
        }
        if ($company !== null) {
            $params['company'] = $company;
        }

        return $this->request('GET', '/people/search', $params);
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
        return $this->request('GET', '/companies/find', ['name' => $name]);
    }

    /**
     * Get the current authenticated user's account information.
     *
     * @return array<string, mixed> The current user's Clearbit account details.
     *
     * @see https://clearbit.com/docs#user-api
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., "/people/find").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
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
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Clearbit API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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
                    Log::warning("Clearbit API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Clearbit API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not be available on your plan or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Clearbit API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Clearbit API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Clearbit API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Clearbit API: {$e->getMessage()}");
        }
    }
}
