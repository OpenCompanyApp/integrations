<?php

namespace OpenCompany\Integrations\StripeConnect;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Stripe Connect API service for making requests to the Stripe REST API.
 *
 * Handles Bearer token authentication for Stripe Connect endpoints
 * including accounts, payouts, balance transactions, capabilities, and users.
 */
class StripeConnectService
{
    private string $baseUrl;

    /**
     * @param  string  $accessToken  Stripe Connect access token (Bearer auth)
     * @param  string  $baseUrl  Base URL for the Stripe API (default: https://api.stripe.com)
     */
    public function __construct(
        private string $accessToken = '',
        string $baseUrl = 'https://api.stripe.com',
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Accounts ───────────────────────────────────────────

    /**
     * List connected accounts.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, etc.)
     * @return array<string, mixed>
     */
    public function listAccounts(array $params = []): array
    {
        return $this->request('GET', '/v1/accounts', $params);
    }

    /**
     * Retrieve a connected account by ID.
     *
     * @return array<string, mixed>
     */
    public function getAccount(string $id): array
    {
        return $this->request('GET', "/v1/accounts/{$id}");
    }

    // ── Payouts ────────────────────────────────────────────

    /**
     * List payouts with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, status, arrival_date, etc.)
     * @return array<string, mixed>
     */
    public function listPayouts(array $params = []): array
    {
        return $this->request('GET', '/v1/payouts', $params);
    }

    /**
     * Retrieve a payout by ID.
     *
     * @return array<string, mixed>
     */
    public function getPayout(string $id): array
    {
        return $this->request('GET', "/v1/payouts/{$id}");
    }

    // ── Balance Transactions ───────────────────────────────

    /**
     * List balance transactions.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, etc.)
     * @return array<string, mixed>
     */
    public function listBalanceTransactions(array $params = []): array
    {
        return $this->request('GET', '/v1/balance_transactions', $params);
    }

    // ── Capabilities ───────────────────────────────────────

    /**
     * List capabilities for an account.
     *
     * @param  array<string, mixed>  $params  Query parameters (account, etc.)
     * @return array<string, mixed>
     */
    public function listCapabilities(array $params = []): array
    {
        return $this->request('GET', '/v1/capabilities', $params);
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * Get the current authenticated user (Connect user).
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to Stripe Connect.
     *
     * @param  array<string, mixed>  $data  Query parameters or request body
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Stripe Connect access token is not configured.');
        }

        try {
            $http = Http::withToken($this->accessToken)
                ->timeout(30);

            $url = $this->baseUrl . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->asForm()->post($url, $data),
                'DELETE' => $http->asForm()->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $json = $response->json() ?? [];

            if (! $response->successful()) {
                $error = $json['error']['message'] ?? $response->body();
                $code = $json['error']['code'] ?? '';
                $type = $json['error']['type'] ?? '';

                Log::error("Stripe Connect API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                    'type' => $type,
                    'code' => $code,
                ]);

                $msg = is_string($error) ? $error : json_encode($error);
                if ($code) {
                    $msg .= " (code: {$code})";
                }

                throw new \RuntimeException('Stripe Connect API error (' . $response->status() . '): ' . $msg);
            }

            return $json;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Stripe Connect API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Stripe Connect API: {$e->getMessage()}");
        }
    }
}
