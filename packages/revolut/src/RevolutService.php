<?php

namespace OpenCompany\Integrations\Revolut;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Revolut API service for making requests to the Revolut Business REST API.
 */
class RevolutService
{
    private const BASE_URL = 'https://b2b.revolut.com/api/1.0';

    /**
     * @param  string  $accessToken  Revolut API access token
     * @param  string  $baseUrl  Revolut Business API base URL
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = self::BASE_URL,
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Accounts ───────────────────────────────────────────

    /**
     * List all accounts.
     *
     * @return array<string, mixed>
     */
    public function listAccounts(): array
    {
        return $this->request('GET', '/accounts');
    }

    /**
     * Get an account by ID.
     *
     * @return array<string, mixed>
     */
    public function getAccount(string $id): array
    {
        return $this->request('GET', "/accounts/{$id}");
    }

    /**
     * Get full bank details for an account.
     *
     * @return array<string, mixed>
     */
    public function getAccountBankDetails(string $id): array
    {
        return $this->request('GET', "/accounts/{$id}/bank-details");
    }

    // ── Transactions ───────────────────────────────────────

    /**
     * List transactions with optional filters.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listTransactions(array $params = []): array
    {
        return $this->request('GET', '/transactions', $params);
    }

    /**
     * Get a transaction by ID.
     *
     * @return array<string, mixed>
     */
    public function getTransaction(string $id): array
    {
        return $this->request('GET', "/transaction/{$id}");
    }

    /**
     * Get a transaction by ID or request ID.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getTransactionById(string $id, array $params = []): array
    {
        return $this->request('GET', "/transaction/{$id}", $params);
    }

    // ── Cards ──────────────────────────────────────────────

    /**
     * List all cards.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listCards(array $params = []): array
    {
        return $this->request('GET', '/cards', $params);
    }

    /**
     * Get a card by ID.
     *
     * @return array<string, mixed>
     */
    public function getCard(string $id): array
    {
        return $this->request('GET', "/cards/{$id}");
    }

    /**
     * Get sensitive card details.
     *
     * Requires Revolut's READ_SENSITIVE_CARD_DATA scope and IP whitelisting.
     *
     * @return array<string, mixed>
     */
    public function getSensitiveCardDetails(string $id): array
    {
        return $this->request('GET', "/cards/{$id}/sensitive-details");
    }

    // ── Team members ──────────────────────────────────────

    /**
     * List team members with optional pagination.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listTeamMembers(array $params = []): array
    {
        return $this->request('GET', '/team-members', $params);
    }

    /**
     * Explain that the Revolut Business API has no current-user endpoint.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        throw new \RuntimeException('Revolut Business API does not expose a current-user endpoint. Use revolut_list_team_members for team visibility.');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to Revolut.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Revolut access token is not configured.');
        }

        try {
            $http = Http::withToken($this->accessToken)
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($this->normalizedBaseUrl() . $path, $data),
                'POST' => $http->post($this->normalizedBaseUrl() . $path, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $json = $response->json() ?? [];

            if (! $response->successful()) {
                $error = $json['message'] ?? $json['error'] ?? $response->body();

                Log::error("Revolut API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                $msg = is_string($error) ? $error : json_encode($error);

                throw new \RuntimeException('Revolut API error (' . $response->status() . '): ' . $msg);
            }

            return $json;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Revolut API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Revolut API: {$e->getMessage()}");
        }
    }

    private function normalizedBaseUrl(): string
    {
        return rtrim($this->baseUrl ?: self::BASE_URL, '/');
    }
}
