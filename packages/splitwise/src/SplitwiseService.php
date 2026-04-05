<?php

namespace OpenCompany\Integrations\Splitwise;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * SplitwiseService — HTTP client for the Splitwise API v3.0.
 *
 * Handles authentication, request execution, and error handling for all
 * Splitwise API interactions including expenses, groups, friends, and users.
 *
 * @see https://dev.splitwise.com/
 */
class SplitwiseService
{
    /**
     * Create a new SplitwiseService instance.
     *
     * @param  string  $accessToken  OAuth2 bearer token for Splitwise API authentication.
     * @param  string  $baseUrl  Base URL for the Splitwise API (defaults to https://secure.splitwise.com/api/v3.0).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://secure.splitwise.com/api/v3.0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     *
     * @return bool True if an access token is set.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the current authenticated user's profile.
     *
     * @return array<string, mixed> The current user data from Splitwise.
     *
     * @see https://dev.splitwise.com/#get_current_user
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/get_current_user');
    }

    /**
     * List expenses for the current user.
     *
     * @param  array<string, mixed>  $params  Optional query parameters (group_id, friend_id, dated_after, dated_before, limit, offset, etc.).
     * @return array<string, mixed> Paginated list of expenses.
     *
     * @see https://dev.splitwise.com/#get_expenses
     */
    public function listExpenses(array $params = []): array
    {
        return $this->request('GET', '/get_expenses', $params);
    }

    /**
     * Get a single expense by ID.
     *
     * @param  int  $id  The expense ID.
     * @return array<string, mixed> The expense data.
     *
     * @see https://dev.splitwise.com/#get_expense
     */
    public function getExpense(int $id): array
    {
        return $this->request('GET', '/get_expense/' . $id);
    }

    /**
     * Create a new expense.
     *
     * @param  array<string, mixed>  $data  Expense data (cost, description, users, currency_code, group_id, etc.).
     * @return array<string, mixed> The created expense data.
     *
     * @see https://dev.splitwise.com/#create_expense
     */
    public function createExpense(array $data): array
    {
        return $this->request('POST', '/create_expense', $data);
    }

    /**
     * List all groups the current user belongs to.
     *
     * @return array<string, mixed> List of groups.
     *
     * @see https://dev.splitwise.com/#get_groups
     */
    public function listGroups(): array
    {
        return $this->request('GET', '/get_groups');
    }

    /**
     * Get a single group by ID.
     *
     * @param  int  $id  The group ID.
     * @return array<string, mixed> The group data including members and balances.
     *
     * @see https://dev.splitwise.com/#get_group
     */
    public function getGroup(int $id): array
    {
        return $this->request('GET', '/get_group/' . $id);
    }

    /**
     * List all friends of the current user.
     *
     * @return array<string, mixed> List of friends with balances.
     *
     * @see https://dev.splitwise.com/#get_friends
     */
    public function listFriends(): array
    {
        return $this->request('GET', '/get_friends');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Splitwise API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Splitwise access token is not configured.');
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
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Splitwise API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Splitwise API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Splitwise API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Splitwise API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Splitwise API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Splitwise API: {$e->getMessage()}");
        }
    }
}
