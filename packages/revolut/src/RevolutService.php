<?php

namespace OpenCompany\Integrations\Revolut;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Revolut API service for making requests to the Revolut Business REST API.
 */
class RevolutService
{
    private const BASE_URL = 'https://api.revolut.com/v1';

    /**
     * @param  string  $accessToken  Revolut API access token
     */
    public function __construct(
        private string $accessToken = '',
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
        return $this->request('GET', "/transactions/{$id}");
    }

    // ── Cards ──────────────────────────────────────────────

    /**
     * List all cards.
     *
     * @return array<string, mixed>
     */
    public function listCards(): array
    {
        return $this->request('GET', '/cards');
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

    // ── User ───────────────────────────────────────────────

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
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
                'GET' => $http->get(self::BASE_URL . $path, $data),
                'POST' => $http->post(self::BASE_URL . $path, $data),
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
}
