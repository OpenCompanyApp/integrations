<?php

namespace OpenCompany\Integrations\Mailgun;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Mailgun REST API.
 *
 * Uses Mailgun Basic Auth with username "api" and the configured API key as
 * the password, and normalizes v3/v4 endpoint paths for all tools.
 */
class MailgunService
{
    /**
     * @param  string  $apiKey  Mailgun private API key.
     * @param  string  $domain  Default sending domain.
     * @param  string  $baseUrl  Mailgun API base URL for v3 endpoints.
     * @param  string  $domainsBaseUrl  Mailgun API base URL for v4 domain endpoints.
     */
    public function __construct(
        private string $apiKey = '',
        private string $domain = '',
        private string $baseUrl = 'https://api.mailgun.net/v3',
        private string $domainsBaseUrl = 'https://api.mailgun.net/v4',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->domainsBaseUrl = rtrim($this->domainsBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    public function getConfiguredDomain(): string
    {
        return $this->domain;
    }

    /**
     * List message events for the configured domain.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listMessages(array $params = []): array
    {
        return $this->apiGet('/' . $this->domain . '/events', $params);
    }

    /**
     * Get message events for the configured domain.
     *
     * @param  array<string, mixed>  $params  Event filters and pagination parameters.
     * @return array<string, mixed>
     */
    public function getEvents(array $params = []): array
    {
        return $this->listMessages($params);
    }

    /**
     * Send a message for the configured domain.
     *
     * @param  array<string, mixed>  $data  Message form fields.
     * @return array<string, mixed>
     */
    public function sendEmail(array $data): array
    {
        return $this->apiPost('/' . $this->domain . '/messages', $data);
    }

    /**
     * Get aggregate message stats for the configured domain.
     *
     * @param  array<string, mixed>  $params  Stats query parameters, including event and duration.
     * @return array<string, mixed>
     */
    public function getStats(array $params = []): array
    {
        return $this->apiGet('/' . $this->domain . '/stats/total', $params);
    }

    /**
     * List domains.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listDomains(array $params = []): array
    {
        return $this->apiGet('/v4/domains', $params);
    }

    /**
     * Get one domain.
     *
     * @return array<string, mixed>
     */
    public function getDomain(string $domainName): array
    {
        return $this->apiGet('/v4/domains/' . rawurlencode($domainName));
    }

    /**
     * List routes.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listRoutes(array $params = []): array
    {
        return $this->apiGet('/routes', $params);
    }

    /**
     * List domain webhooks.
     *
     * @return array<string, mixed>
     */
    public function listWebhooks(string $domainName = ''): array
    {
        return $this->apiGet('/domains/' . rawurlencode($domainName ?: $this->domain) . '/webhooks');
    }

    /**
     * Get basic account visibility by listing one domain.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->listDomains(['limit' => 1]);
    }

    /**
     * List bounce suppressions for the configured domain.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function getSuppressions(array $params = []): array
    {
        return $this->apiGet('/' . $this->domain . '/bounces', $params);
    }

    /**
     * Create a bounce suppression for the configured domain.
     *
     * @param  array<string, mixed>  $data  Suppression form fields.
     * @return array<string, mixed>
     */
    public function createSuppression(array $data): array
    {
        return $this->apiPost('/' . $this->domain . '/bounces', $data);
    }

    /**
     * List mailing lists for the account.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listMailingLists(array $params = []): array
    {
        return $this->apiGet('/lists', $params);
    }

    /**
     * Create a mailing list.
     *
     * @param  array<string, mixed>  $data  Mailing list form fields.
     * @return array<string, mixed>
     */
    public function createMailingList(array $data): array
    {
        return $this->apiPost('/lists', $data);
    }

    /**
     * List members for a mailing list.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listMembers(string $listAddress, array $params = []): array
    {
        return $this->apiGet('/lists/' . rawurlencode($listAddress) . '/members', $params);
    }

    /**
     * Add or update a mailing-list member.
     *
     * @param  array<string, mixed>  $data  Member form fields.
     * @return array<string, mixed>
     */
    public function addMember(string $listAddress, array $data): array
    {
        return $this->apiPost('/lists/' . rawurlencode($listAddress) . '/members', $data);
    }

    /**
     * Bulk add mailing-list members using Mailgun's JSON import endpoint.
     *
     * @param  array<string, mixed>  $data  Bulk import form fields.
     * @return array<string, mixed>
     */
    public function addMemberBulk(string $listAddress, array $data): array
    {
        return $this->apiPost('/lists/' . rawurlencode($listAddress) . '/members.json', $data);
    }

    /**
     * Send a GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Send a POST request.
     *
     * @param  array<string, mixed>  $data  Form body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $data = [], array $query = []): array
    {
        return $this->request('POST', $path, $data, $query);
    }

    /**
     * Send a PUT request.
     *
     * @param  array<string, mixed>  $data  Form body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $data = [], array $query = []): array
    {
        return $this->request('PUT', $path, $data, $query);
    }

    /**
     * Send a DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, $query);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query params (GET/DELETE) or form body (POST/PUT).
     * @param  array<string, mixed>  $query  Query params for mutating requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $query);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to Mailgun.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): Response
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('Mailgun API key is not configured.');
        }

        [$baseUrl, $normalizedPath] = $this->resolveEndpoint($path);
        $url = $baseUrl . $normalizedPath;

        try {
            $http = Http::withBasicAuth('api', $this->apiKey)
                ->withHeaders(['Accept' => 'application/json'])
                ->asForm()
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->withOptions(['query' => $query])->post($url, $data),
                'PUT' => $http->withOptions(['query' => $query])->put($url, $data),
                'DELETE' => $http->withOptions(['query' => $data])->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $body = $response->body();
                $error = $response->json('message') ?? $response->json('error') ?? $body;

                Log::error("Mailgun API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('Mailgun API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Mailgun API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Mailgun API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize v3/v4-prefixed paths into the configured API base URLs.
     *
     * @return array{0: string, 1: string}
     */
    private function resolveEndpoint(string $path): array
    {
        $path = '/' . ltrim($path, '/');

        if (str_starts_with($path, '/v4/')) {
            return [$this->domainsBaseUrl, substr($path, 3)];
        }

        if (str_starts_with($path, '/v3/')) {
            return [$this->baseUrl, substr($path, 3)];
        }

        return [$this->baseUrl, $path];
    }
}
