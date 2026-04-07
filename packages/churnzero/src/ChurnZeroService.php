<?php

namespace OpenCompany\Integrations\ChurnZero;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * ChurnZero customer success API service.
 *
 * Handles HTTP communication with the ChurnZero API using Bearer token
 * authentication. Provides methods for accounts, contacts, alerts,
 * usage tracking, and user management.
 *
 * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
 */
class ChurnZeroService
{
    /**
     * Create a new ChurnZeroService instance.
     *
     * @param  string  $apiKey  ChurnZero API key used as Bearer token.
     * @param  string  $baseUrl  Base URL for the ChurnZero API (defaults to https://api.churnzero.net/v1).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.churnzero.net/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ─── Accounts ─────────────────────────────────────────────────────────

    /**
     * List accounts with optional filtering and pagination.
     *
     * @param  string|null  $search  Search term to filter accounts.
     * @param  int  $page  Page number for pagination (default 1).
     * @param  int  $perPage  Number of results per page (default 25, max 100).
     * @return array<string, mixed> API response containing accounts and pagination info.
     *
     * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
     */
    public function listAccounts(?string $search = null, int $page = 1, int $perPage = 25): array
    {
        $params = [
            'page' => $page,
            'perPage' => min($perPage, 100),
        ];
        if ($search !== null) {
            $params['search'] = $search;
        }

        return $this->request('GET', '/accounts', $params);
    }

    /**
     * Get a single account by ID.
     *
     * @param  string  $id  The account ID.
     * @return array<string, mixed> The account data.
     *
     * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
     */
    public function getAccount(string $id): array
    {
        return $this->request('GET', '/accounts/' . urlencode($id));
    }

    // ─── Contacts ─────────────────────────────────────────────────────────

    /**
     * List contacts with optional filtering and pagination.
     *
     * @param  string|null  $accountId  Filter contacts by account ID.
     * @param  string|null  $search  Search term to filter contacts.
     * @param  int  $page  Page number for pagination (default 1).
     * @param  int  $perPage  Number of results per page (default 25, max 100).
     * @return array<string, mixed> API response containing contacts and pagination info.
     *
     * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
     */
    public function listContacts(?string $accountId = null, ?string $search = null, int $page = 1, int $perPage = 25): array
    {
        $params = [
            'page' => $page,
            'perPage' => min($perPage, 100),
        ];
        if ($accountId !== null) {
            $params['accountId'] = $accountId;
        }
        if ($search !== null) {
            $params['search'] = $search;
        }

        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  string  $id  The contact ID.
     * @return array<string, mixed> The contact data.
     *
     * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', '/contacts/' . urlencode($id));
    }

    // ─── Alerts ───────────────────────────────────────────────────────────

    /**
     * List alerts with optional filtering and pagination.
     *
     * @param  string|null  $accountId  Filter alerts by account ID.
     * @param  string|null  $status  Filter by alert status (e.g., "open", "dismissed").
     * @param  int  $page  Page number for pagination (default 1).
     * @param  int  $perPage  Number of results per page (default 25, max 100).
     * @return array<string, mixed> API response containing alerts and pagination info.
     *
     * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
     */
    public function listAlerts(?string $accountId = null, ?string $status = null, int $page = 1, int $perPage = 25): array
    {
        $params = [
            'page' => $page,
            'perPage' => min($perPage, 100),
        ];
        if ($accountId !== null) {
            $params['accountId'] = $accountId;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/alerts', $params);
    }

    // ─── Usage ────────────────────────────────────────────────────────────

    /**
     * List usage data with optional filtering and pagination.
     *
     * @param  string|null  $accountId  Filter usage by account ID.
     * @param  string|null  $feature  Filter by usage feature/module name.
     * @param  int  $page  Page number for pagination (default 1).
     * @param  int  $perPage  Number of results per page (default 25, max 100).
     * @return array<string, mixed> API response containing usage data and pagination info.
     *
     * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
     */
    public function listUsage(?string $accountId = null, ?string $feature = null, int $page = 1, int $perPage = 25): array
    {
        $params = [
            'page' => $page,
            'perPage' => min($perPage, 100),
        ];
        if ($accountId !== null) {
            $params['accountId'] = $accountId;
        }
        if ($feature !== null) {
            $params['feature'] = $feature;
        }

        return $this->request('GET', '/usage', $params);
    }

    // ─── User ─────────────────────────────────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed> The user profile data.
     *
     * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    // ─── Internal helpers ─────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g. "/accounts").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> Parsed JSON response.
     *
     * @throws \RuntimeException On API errors or connection failures.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the ChurnZero API using Bearer token auth.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters (GET) or JSON body (POST/PUT/DELETE).
     * @return Response The raw HTTP response.
     *
     * @throws \RuntimeException On API errors, connection failures, or missing API key.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('ChurnZero API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withToken($this->apiKey)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("ChurnZero API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("ChurnZero API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $errors = $response->json('errors') ?? $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("ChurnZero API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $errors,
                ]);
                throw new \RuntimeException("ChurnZero API error ({$response->status()}): " . (is_string($errors) ? $errors : json_encode($errors)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ChurnZero API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ChurnZero API: {$e->getMessage()}");
        }
    }
}
