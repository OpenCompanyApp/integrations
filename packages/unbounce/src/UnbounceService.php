<?php

namespace OpenCompany\Integrations\Unbounce;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Unbounce REST API.
 *
 * Handles bearer-token authentication, paginated resource helpers, lead
 * creation/deletion workflows, and safe raw relative API calls.
 */
class UnbounceService
{
    /**
     * @param  string  $accessToken  Unbounce OAuth bearer token.
     * @param  string  $baseUrl  Unbounce API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.unbounce.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Retrieve the API root metadata.
     *
     * @return array<string, mixed>
     */
    public function getApiMetadata(): array
    {
        return $this->apiGet('/');
    }

    /**
     * List accounts available to the token.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAccounts(array $params = []): array
    {
        return $this->apiGet('/accounts', $params);
    }

    /**
     * Get one account by ID.
     *
     * @param  string  $accountId  Account ID.
     * @return array<string, mixed>
     */
    public function getAccount(string $accountId): array
    {
        return $this->apiGet('/accounts/' . rawurlencode($accountId));
    }

    /**
     * List landing pages globally or within an account/sub-account/domain/page group.
     *
     * @param  int  $limit  Maximum number of pages.
     * @param  int  $offset  Pagination offset.
     * @param  string|null  $sort  Sort order mapped to Unbounce sort_order.
     * @param  array<string, mixed>  $params  Additional query parameters.
     * @param  string|null  $scopePath  Optional scoped collection path.
     * @return array<string, mixed>
     */
    public function listPages(int $limit = 50, int $offset = 0, ?string $sort = null, array $params = [], ?string $scopePath = null): array
    {
        $query = array_merge($params, [
            'limit' => $limit,
            'offset' => $offset,
        ]);

        if ($sort !== null && $sort !== '') {
            $query['sort_order'] = str_starts_with($sort, '-') ? 'desc' : $sort;
        }

        return $this->apiGet($scopePath ?: '/pages', $query);
    }

    /**
     * List pages for an account.
     *
     * @param  string  $accountId  Account ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAccountPages(string $accountId, array $params = []): array
    {
        return $this->apiGet('/accounts/' . rawurlencode($accountId) . '/pages', $params);
    }

    /**
     * List pages for a sub-account.
     *
     * @param  string  $subAccountId  Sub-account ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listSubAccountPages(string $subAccountId, array $params = []): array
    {
        return $this->apiGet('/sub_accounts/' . rawurlencode($subAccountId) . '/pages', $params);
    }

    /**
     * List pages for a domain.
     *
     * @param  string  $domainId  Domain ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listDomainPages(string $domainId, array $params = []): array
    {
        return $this->apiGet('/domains/' . rawurlencode($domainId) . '/pages', $params);
    }

    /**
     * List pages for a page group.
     *
     * @param  string  $pageGroupId  Page group ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listPageGroupPages(string $pageGroupId, array $params = []): array
    {
        return $this->apiGet('/page_groups/' . rawurlencode($pageGroupId) . '/pages', $params);
    }

    /**
     * Get a single landing page by ID.
     *
     * @param  string  $pageId  Page ID.
     * @return array<string, mixed>
     */
    public function getPage(string $pageId): array
    {
        return $this->apiGet('/pages/' . rawurlencode($pageId));
    }

    /**
     * List form fields for a page.
     *
     * @param  string  $pageId  Page ID.
     * @return array<string, mixed>
     */
    public function listPageFormFields(string $pageId): array
    {
        return $this->apiGet('/pages/' . rawurlencode($pageId) . '/form_fields');
    }

    /**
     * List leads for a page.
     *
     * @param  string  $pageId  Page ID.
     * @param  int  $limit  Maximum number of leads.
     * @param  int  $offset  Pagination offset.
     * @param  array<string, mixed>  $params  Additional query parameters.
     * @return array<string, mixed>
     */
    public function listLeads(string $pageId, int $limit = 50, int $offset = 0, array $params = []): array
    {
        return $this->apiGet('/pages/' . rawurlencode($pageId) . '/leads', array_merge($params, [
            'limit' => $limit,
            'offset' => $offset,
        ]));
    }

    /**
     * Create a lead for a page.
     *
     * @param  string  $pageId  Page ID.
     * @param  array<string, mixed>  $payload  Lead creation payload.
     * @return array<string, mixed>
     */
    public function createLead(string $pageId, array $payload): array
    {
        return $this->apiPost('/pages/' . rawurlencode($pageId) . '/leads', $payload);
    }

    /**
     * Get a single lead by ID.
     *
     * @param  string  $leadId  Lead ID.
     * @return array<string, mixed>
     */
    public function getLead(string $leadId): array
    {
        return $this->apiGet('/leads/' . rawurlencode($leadId));
    }

    /**
     * Create a lead deletion request for a page.
     *
     * @param  string  $pageId  Page ID.
     * @param  array<string, mixed>  $payload  Deletion request payload.
     * @return array<string, mixed>
     */
    public function createLeadDeletionRequest(string $pageId, array $payload): array
    {
        return $this->apiPost('/pages/' . rawurlencode($pageId) . '/lead_deletion_request', $payload);
    }

    /**
     * Get a lead deletion request by page and request ID.
     *
     * @param  string  $pageId  Page ID.
     * @param  string  $requestId  Deletion request ID.
     * @return array<string, mixed>
     */
    public function getLeadDeletionRequest(string $pageId, string $requestId): array
    {
        return $this->apiGet('/pages/' . rawurlencode($pageId) . '/lead_deletion_request/' . rawurlencode($requestId));
    }

    /**
     * List sub-accounts globally or within an account.
     *
     * @param  int  $limit  Maximum number of sub-accounts.
     * @param  int  $offset  Pagination offset.
     * @param  string|null  $accountId  Optional account ID for the official scoped endpoint.
     * @param  array<string, mixed>  $params  Additional query parameters.
     * @return array<string, mixed>
     */
    public function listSubAccounts(int $limit = 50, int $offset = 0, ?string $accountId = null, array $params = []): array
    {
        $path = $accountId ? '/accounts/' . rawurlencode($accountId) . '/sub_accounts' : '/sub_accounts';

        return $this->apiGet($path, array_merge($params, [
            'limit' => $limit,
            'offset' => $offset,
        ]));
    }

    /**
     * Get one sub-account by ID.
     *
     * @param  string  $subAccountId  Sub-account ID.
     * @return array<string, mixed>
     */
    public function getSubAccount(string $subAccountId): array
    {
        return $this->apiGet('/sub_accounts/' . rawurlencode($subAccountId));
    }

    /**
     * List domains for a sub-account.
     *
     * @param  string  $subAccountId  Sub-account ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listDomains(string $subAccountId, array $params = []): array
    {
        return $this->apiGet('/sub_accounts/' . rawurlencode($subAccountId) . '/domains', $params);
    }

    /**
     * Get one domain by ID.
     *
     * @param  string  $domainId  Domain ID.
     * @return array<string, mixed>
     */
    public function getDomain(string $domainId): array
    {
        return $this->apiGet('/domains/' . rawurlencode($domainId));
    }

    /**
     * List page groups for a sub-account.
     *
     * @param  string  $subAccountId  Sub-account ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listPageGroups(string $subAccountId, array $params = []): array
    {
        return $this->apiGet('/sub_accounts/' . rawurlencode($subAccountId) . '/page_groups', $params);
    }

    /**
     * Get one page group by ID.
     *
     * @param  string  $pageGroupId  Page group ID.
     * @return array<string, mixed>
     */
    public function getPageGroup(string $pageGroupId): array
    {
        return $this->apiGet('/page_groups/' . rawurlencode($pageGroupId));
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/users/me');
    }

    /**
     * Make a safe relative GET request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, [], $query);
    }

    /**
     * Make a safe relative POST request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, $body, $query);
    }

    /**
     * Make a safe relative DELETE request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, [], $query);
    }

    /**
     * Make an API request and return parsed JSON or raw body.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $body = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $body, $query);
        $json = $response->json();

        return is_array($json) ? $json : ['raw' => $response->body()];
    }

    /**
     * Make a raw HTTP request to the Unbounce API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $body = [], array $query = []): Response
    {
        $url = $this->buildUrl($path, $query);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->requireAccessToken(),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'DELETE' => $http->delete($url),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $bodyText = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($bodyText), '<!DOCTYPE')) {
                    Log::warning("Unbounce API returned HTML for {$method} {$path}", ['status' => $response->status()]);
                    throw new \RuntimeException("Unbounce API endpoint not available (HTTP {$response->status()}). Check the API base URL.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $bodyText;
                Log::error("Unbounce API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Unbounce API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Unbounce API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Unbounce API: {$e->getMessage()}");
        }
    }

    /**
     * Return an access token or throw a clear configuration error.
     */
    private function requireAccessToken(): string
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Unbounce access token is not configured.');
        }

        return $this->accessToken;
    }

    /**
     * Convert a safe relative path and query array into a full URL.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildUrl(string $path, array $query): string
    {
        $path = '/' . ltrim($path, '/');

        if (str_contains($path, '://') || str_starts_with($path, '//') || str_contains($path, '..')) {
            throw new \RuntimeException('Unbounce API path must be a safe relative path.');
        }

        $query = array_filter($query, static fn ($value): bool => $value !== null && $value !== '');
        $queryString = $this->queryString($query);

        return $this->baseUrl . $path . ($queryString === '' ? '' : '?' . $queryString);
    }

    /**
     * Build a query string while preserving repeated array values.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function queryString(array $query): string
    {
        $parts = [];

        foreach ($query as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $entry) {
                    if ($entry !== null && $entry !== '') {
                        $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $entry);
                    }
                }

                continue;
            }

            $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $value);
        }

        return implode('&', $parts);
    }
}
