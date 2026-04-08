<?php

namespace OpenCompany\Integrations\Venmo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Venmo API service for making requests to the Venmo REST API.
 */
class VenmoService
{
    private const BASE_URL = 'https://api.venmo.com/v1';

    /**
     * @param  string  $accessToken  Venmo OAuth access token
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Payments ───────────────────────────────────────────

    /**
     * List payments.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listPayments(array $params = []): array
    {
        return $this->request('GET', '/payments', $params);
    }

    /**
     * Get a payment by ID.
     *
     * @return array<string, mixed>
     */
    public function getPayment(string $id): array
    {
        return $this->request('GET', "/payments/{$id}");
    }

    /**
     * Create a payment.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createPayment(array $data): array
    {
        return $this->request('POST', '/payments', $data);
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * List users.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * Get a user by ID.
     *
     * @return array<string, mixed>
     */
    public function getUser(string $id): array
    {
        return $this->request('GET', "/users/{$id}");
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    // ── Transactions ───────────────────────────────────────

    /**
     * List transactions.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listTransactions(array $params = []): array
    {
        return $this->request('GET', '/transactions', $params);
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to Venmo.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Venmo access token is not configured.');
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
                $error = $json['error']['message'] ?? $json['message'] ?? $response->body();

                Log::error("Venmo API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                $msg = is_string($error) ? $error : json_encode($error);

                throw new \RuntimeException('Venmo API error (' . $response->status() . '): ' . $msg);
            }

            return $json;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Venmo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Venmo API: {$e->getMessage()}");
        }
    }
}
