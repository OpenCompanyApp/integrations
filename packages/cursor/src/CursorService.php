<?php

namespace OpenCompany\Integrations\Cursor;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Cursor Admin API.
 *
 * Handles Basic authentication and documented team usage, spending, and repo blocklist endpoints.
 */
class CursorService
{
    /**
     * @param  string  $apiKey  Cursor Admin API key.
     * @param  string  $baseUrl  Cursor Admin API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.cursor.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Cursor integration is properly configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    /**
     * Retrieve all team members and their roles.
     *
     * @return array<string, mixed>
     */
    public function listTeamMembers(): array
    {
        return $this->request('GET', '/teams/members');
    }

    /**
     * Retrieve daily team usage data for a date range.
     *
     * @param  array<string, mixed>  $params  Request body (startDate, endDate).
     * @return array<string, mixed>
     */
    public function getDailyUsageData(array $params = []): array
    {
        return $this->request('POST', '/teams/daily-usage-data', $params);
    }

    /**
     * Retrieve current-cycle spending data with optional search, sorting, and pagination.
     *
     * @param  array<string, mixed>  $params  Request body (searchTerm, sortBy, sortDirection, page, pageSize).
     * @return array<string, mixed>
     */
    public function getSpend(array $params = []): array
    {
        return $this->request('POST', '/teams/spend', $params);
    }

    /**
     * Retrieve detailed filtered usage events.
     *
     * @param  array<string, mixed>  $params  Request body (startDate, endDate, userId, email, page, pageSize).
     * @return array<string, mixed>
     */
    public function getUsageEvents(array $params = []): array
    {
        return $this->request('POST', '/teams/filtered-usage-events', $params);
    }

    /**
     * Set a team member's spend limit in whole dollars.
     *
     * @return array<string, mixed>
     */
    public function setUserSpendLimit(string $userEmail, int $spendLimitDollars): array
    {
        return $this->request('POST', '/teams/user-spend-limit', [
            'userEmail' => $userEmail,
            'spendLimitDollars' => $spendLimitDollars,
        ]);
    }

    /**
     * List all repository blocklists configured for the team.
     *
     * @return array<string, mixed>
     */
    public function listRepoBlocklists(): array
    {
        return $this->request('GET', '/settings/repo-blocklists/repos');
    }

    /**
     * Upsert repository blocklist patterns.
     *
     * @param  array<int, array<string, mixed>>  $repos  Repository blocklist objects (url, patterns).
     * @return array<string, mixed>
     */
    public function upsertRepoBlocklists(array $repos): array
    {
        return $this->request('POST', '/settings/repo-blocklists/repos/upsert', ['repos' => array_values($repos)]);
    }

    /**
     * Delete a repository blocklist entry.
     *
     * @return array<string, mixed>
     */
    public function deleteRepoBlocklist(string $repoId): array
    {
        $this->rawRequest('DELETE', '/settings/repo-blocklists/repos/' . rawurlencode($repoId));

        return ['deleted' => true, 'repo_id' => $repoId];
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Cursor Admin API.
     *
     * @param  string  $method  HTTP method (GET, POST, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return Response
     *
     * @throws RuntimeException If the API key is missing, the request fails, or the response is unexpected.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->apiKey) {
            throw new RuntimeException('Cursor API key is not configured.');
        }

        $url = $this->baseUrl . $path;
        $data = array_filter($data, static fn (mixed $value): bool => $value !== null && $value !== '');

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($this->apiKey . ':'),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Cursor API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("Cursor API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Cursor API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Cursor API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Cursor API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Cursor API: {$e->getMessage()}");
        }
    }
}
