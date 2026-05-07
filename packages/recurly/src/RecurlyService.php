<?php

namespace OpenCompany\Integrations\Recurly;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Recurly v3 API.
 *
 * Handles bearer API-key authentication, Recurly version headers,
 * request dispatch, error normalization, and JSON response parsing.
 */
class RecurlyService
{
    /**
     * The Recurly API key used for Bearer authentication.
     */
    private string $apiKey;

    /**
     * The Recurly subdomain (e.g., "mycompany" for mycompany.recurly.com).
     */
    private string $subdomain;

    /**
     * The base URL for the Recurly v3 API.
     */
    private string $baseUrl;

    /**
     * The Recurly API version header value.
     */
    private const API_VERSION = 'application/vnd.recurly.v2021-02-25';

    /**
     * Create a new RecurlyService instance.
     *
     * @param string $apiKey    The Recurly API key for Bearer auth.
     * @param string $subdomain The Recurly subdomain.
     */
    public function __construct(
        string $apiKey = '',
        string $subdomain = '',
    ) {
        $this->apiKey = $apiKey;
        $this->subdomain = $subdomain;
        $this->baseUrl = 'https://v3.recurly.com';
    }

    /**
     * Check whether the service is configured with an API key.
     *
     * @return bool True if an API key is set.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the configured subdomain.
     *
     * @return string The Recurly subdomain.
     */
    public function getSubdomain(): string
    {
        return $this->subdomain;
    }

    /**
     * List accounts from Recurly.
     *
     * @param int|null       $limit  Maximum number of accounts to return.
     * @param string|null    $cursor Cursor for pagination.
     * @param string|null    $email  Filter by email address.
     * @param string|null    $state  Filter by account state (active, closed, inactive).
     * @return array The API response data.
     */
    public function listAccounts(?int $limit = null, ?string $cursor = null, ?string $email = null, ?string $state = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }
        if ($email !== null) {
            $params['email'] = $email;
        }
        if ($state !== null) {
            $params['state'] = $state;
        }

        return $this->request('GET', '/accounts', $params);
    }

    /**
     * Get a single account by its ID or code.
     *
     * @param string $id The account ID (e.g., "code-xxx" or "uuid").
     * @return array The account data.
     */
    public function getAccount(string $id): array
    {
        return $this->request('GET', '/accounts/' . urlencode($id));
    }

    /**
     * Create a new account in Recurly.
     *
     * @param string      $code      The unique account code (required).
     * @param string|null $email     The account email address.
     * @param string|null $firstName The account holder's first name.
     * @param string|null $lastName  The account holder's last name.
     * @return array The created account data.
     */
    public function createAccount(string $code, ?string $email = null, ?string $firstName = null, ?string $lastName = null): array
    {
        $data = ['code' => $code];
        if ($email !== null) {
            $data['email'] = $email;
        }
        if ($firstName !== null) {
            $data['first_name'] = $firstName;
        }
        if ($lastName !== null) {
            $data['last_name'] = $lastName;
        }

        return $this->request('POST', '/accounts', $data);
    }

    /**
     * List subscriptions from Recurly.
     *
     * @param int|null    $limit     Maximum number of subscriptions to return.
     * @param string|null $cursor    Cursor for pagination.
     * @param string|null $accountId Filter by account ID.
     * @param string|null $state     Filter by subscription state (active, canceled, expired, future, paused, trial).
     * @return array The API response data.
     */
    public function listSubscriptions(?int $limit = null, ?string $cursor = null, ?string $accountId = null, ?string $state = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }
        if ($accountId !== null) {
            $params['account_id'] = $accountId;
        }
        if ($state !== null) {
            $params['state'] = $state;
        }

        return $this->request('GET', '/subscriptions', $params);
    }

    /**
     * Get a single subscription by its ID.
     *
     * @param string $id The subscription UUID.
     * @return array The subscription data.
     */
    public function getSubscription(string $id): array
    {
        return $this->request('GET', '/subscriptions/' . urlencode($id));
    }

    /**
     * List plans from Recurly.
     *
     * @param int|null    $limit  Maximum number of plans to return.
     * @param string|null $cursor Cursor for pagination.
     * @return array The API response data.
     */
    public function listPlans(?int $limit = null, ?string $cursor = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/plans', $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method The HTTP method (GET, POST, PUT, DELETE).
     * @param string $path   The API endpoint path.
     * @param array  $data   Query parameters or request body.
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Recurly v3 API.
     *
     * Uses Bearer token authentication and the Recurly API version
     * Accept header as required by the v3 API specification.
     *
     * @param string $method The HTTP method (GET, POST, PUT, DELETE).
     * @param string $path   The API endpoint path.
     * @param array  $data   Query parameters or request body.
     * @return Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Recurly API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => self::API_VERSION,
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
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("Recurly API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Recurly API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Recurly API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Recurly API: {$e->getMessage()}");
        }
    }
}
