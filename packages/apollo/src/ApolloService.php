<?php

namespace OpenCompany\Integrations\Apollo;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Apollo REST API.
 *
 * Handles X-Api-Key authentication, documented endpoint routing, query/body
 * separation, JSON response parsing, and Apollo API error normalization.
 */
class ApolloService
{
    /**
     * @param  string  $apiKey  Apollo API key.
     * @param  string  $baseUrl  Apollo API base URL.
     */
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
        return $this->apiKey !== '';
    }

    /**
     * Search net-new people in Apollo's database.
     *
     * @param  array<string, mixed>  $params  People API search filters.
     * @return array<string, mixed>
     */
    public function searchPeople(array $params = []): array
    {
        return $this->request('POST', '/api/v1/mixed_people/api_search', query: $params);
    }

    /**
     * Enrich one person by email, name, ID, LinkedIn URL, domain, or related attributes.
     *
     * @param  array<string, mixed>  $params  People enrichment query parameters.
     * @return array<string, mixed>
     */
    public function enrichPerson(array $params): array
    {
        return $this->request('POST', '/api/v1/people/match', query: $params);
    }

    /**
     * Enrich up to 10 people in a single request.
     *
     * @param  array<int, array<string, mixed>>  $details  Person match objects.
     * @param  array<string, mixed>  $params  Optional enrichment query parameters.
     * @return array<string, mixed>
     */
    public function bulkEnrichPeople(array $details, array $params = []): array
    {
        return $this->request('POST', '/api/v1/people/bulk_match', query: $params, body: ['details' => $details]);
    }

    /**
     * Search companies in Apollo's database.
     *
     * @param  array<string, mixed>  $params  Organization search filters.
     * @return array<string, mixed>
     */
    public function searchOrganizations(array $params = []): array
    {
        return $this->request('POST', '/api/v1/mixed_companies/search', query: $params);
    }

    /**
     * Enrich one organization by domain.
     *
     * @param  string  $domain  Company domain without protocol or www.
     * @return array<string, mixed>
     */
    public function enrichOrganization(string $domain): array
    {
        return $this->request('GET', '/api/v1/organizations/enrich', query: ['domain' => $domain]);
    }

    /**
     * Enrich up to 10 organizations by domain.
     *
     * @param  string[]  $domains  Company domains.
     * @return array<string, mixed>
     */
    public function bulkEnrichOrganizations(array $domains): array
    {
        return $this->request('POST', '/api/v1/organizations/bulk_enrich', query: ['domains' => $domains]);
    }

    /**
     * List current job postings for an organization.
     *
     * @param  string  $organizationId  Apollo organization ID.
     * @param  array<string, mixed>  $params  Pagination parameters.
     * @return array<string, mixed>
     */
    public function listOrganizationJobPostings(string $organizationId, array $params = []): array
    {
        return $this->request('GET', '/api/v1/organizations/'.rawurlencode($organizationId).'/job_postings', query: $params);
    }

    /**
     * Search contacts saved in the team's Apollo account.
     *
     * @param  array<string, mixed>  $params  Contact search filters.
     * @return array<string, mixed>
     */
    public function searchContacts(array $params = []): array
    {
        return $this->request('POST', '/api/v1/contacts/search', body: $params);
    }

    /**
     * View a saved contact by ID.
     *
     * @param  string  $contactId  Apollo contact ID.
     * @return array<string, mixed>
     */
    public function getContact(string $contactId): array
    {
        return $this->request('GET', '/api/v1/contacts/'.rawurlencode($contactId));
    }

    /**
     * Create a saved contact.
     *
     * @param  array<string, mixed>  $attributes  Contact attributes.
     * @return array<string, mixed>
     */
    public function createContact(array $attributes): array
    {
        return $this->request('POST', '/api/v1/contacts', body: $attributes);
    }

    /**
     * Update a saved contact.
     *
     * @param  string  $contactId  Apollo contact ID.
     * @param  array<string, mixed>  $attributes  Contact attributes to update.
     * @return array<string, mixed>
     */
    public function updateContact(string $contactId, array $attributes): array
    {
        return $this->request('PATCH', '/api/v1/contacts/'.rawurlencode($contactId), body: $attributes);
    }

    /**
     * Create up to 100 saved contacts.
     *
     * @param  array<int, array<string, mixed>>  $contacts  Contact attribute objects.
     * @param  array<string, mixed>  $options  Bulk creation options.
     * @return array<string, mixed>
     */
    public function bulkCreateContacts(array $contacts, array $options = []): array
    {
        return $this->request('POST', '/api/v1/contacts/bulk_create', body: ['contacts' => $contacts] + $options);
    }

    /**
     * List contact stages available in the Apollo account.
     *
     * @return array<string, mixed>
     */
    public function listContactStages(): array
    {
        return $this->request('GET', '/api/v1/contact_stages');
    }

    /**
     * Search accounts saved in the team's Apollo account.
     *
     * @param  array<string, mixed>  $params  Account search filters.
     * @return array<string, mixed>
     */
    public function searchAccounts(array $params = []): array
    {
        return $this->request('POST', '/api/v1/accounts/search', body: $params);
    }

    /**
     * View a saved account by ID.
     *
     * @param  string  $accountId  Apollo account ID.
     * @return array<string, mixed>
     */
    public function getAccount(string $accountId): array
    {
        return $this->request('GET', '/api/v1/accounts/'.rawurlencode($accountId));
    }

    /**
     * Backward-compatible organization detail helper using the account view endpoint.
     *
     * @param  string  $id  Apollo account ID.
     * @return array<string, mixed>
     */
    public function getOrganization(string $id): array
    {
        return $this->getAccount($id);
    }

    /**
     * Create a saved account.
     *
     * @param  array<string, mixed>  $attributes  Account attributes.
     * @return array<string, mixed>
     */
    public function createAccount(array $attributes): array
    {
        return $this->request('POST', '/api/v1/accounts', body: $attributes);
    }

    /**
     * Update a saved account.
     *
     * @param  string  $accountId  Apollo account ID.
     * @param  array<string, mixed>  $attributes  Account attributes to update.
     * @return array<string, mixed>
     */
    public function updateAccount(string $accountId, array $attributes): array
    {
        return $this->request('PATCH', '/api/v1/accounts/'.rawurlencode($accountId), body: $attributes);
    }

    /**
     * Create up to 100 saved accounts.
     *
     * @param  array<int, array<string, mixed>>  $accounts  Account attribute objects.
     * @param  array<string, mixed>  $options  Bulk creation options.
     * @return array<string, mixed>
     */
    public function bulkCreateAccounts(array $accounts, array $options = []): array
    {
        return $this->request('POST', '/api/v1/accounts/bulk_create', body: ['accounts' => $accounts] + $options);
    }

    /**
     * List account stages available in the Apollo account.
     *
     * @return array<string, mixed>
     */
    public function listAccountStages(): array
    {
        return $this->request('GET', '/api/v1/account_stages');
    }

    /**
     * List team users.
     *
     * @return array<string, mixed>
     */
    public function listUsers(): array
    {
        return $this->request('GET', '/api/v1/users');
    }

    /**
     * Get the currently authenticated user's profile when available.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v1/users/me');
    }

    /**
     * List email accounts available to the team.
     *
     * @return array<string, mixed>
     */
    public function listEmailAccounts(): array
    {
        return $this->request('GET', '/api/v1/email_accounts');
    }

    /**
     * View API usage and rate limit statistics.
     *
     * @return array<string, mixed>
     */
    public function getApiUsageStats(): array
    {
        return $this->request('POST', '/api/v1/usage_stats/api_usage');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Make a raw HTTP request to the Apollo API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  Request payload.
     *
     * @throws RuntimeException When the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (! $this->apiKey) {
            throw new RuntimeException('Apollo API key is not configured.');
        }

        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrl.$path, $query);

        try {
            $http = Http::withHeaders([
                'X-Api-Key' => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Cache-Control' => 'no-cache',
            ])->timeout(30);

            $response = match ($method) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PATCH' => $http->patch($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();

                Log::error("Apollo API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('Apollo API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Apollo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Apollo API: {$e->getMessage()}");
        }
    }

    /**
     * Append query parameters to a URL, including array-valued Apollo filters.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];

        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $queryKey = is_array($value) && ! str_contains((string) $key, '[') ? $key.'[]' : $key;

            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item === null || $item === '') {
                    continue;
                }

                $parts[] = rawurlencode((string) $queryKey).'='.rawurlencode(is_bool($item) ? ($item ? 'true' : 'false') : (string) $item);
            }
        }

        return $parts === [] ? $url : $url.'?'.implode('&', $parts);
    }
}
