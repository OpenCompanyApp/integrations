<?php

namespace OpenCompany\Integrations\Square;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Square API service for making requests to the Square REST API.
 */
class SquareService
{
    private const BASE_URL = 'https://api.squareup.com/v2';

    /**
     * @param  string  $accessToken  Square access token
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

    // ── Customers ──────────────────────────────────────────

    /**
     * List customers.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers', $params);
    }

    /**
     * Get a customer by ID.
     *
     * @return array<string, mixed>
     */
    public function getCustomer(string $id): array
    {
        return $this->request('GET', "/customers/{$id}");
    }

    // ── Orders ─────────────────────────────────────────────

    /**
     * List orders.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listOrders(array $params = []): array
    {
        $locationId = $params['location_id'] ?? '';
        unset($params['location_id']);

        if (empty($locationId)) {
            throw new \RuntimeException('location_id is required for listing orders.');
        }

        return $this->request('GET', "/locations/{$locationId}/orders", $params);
    }

    /**
     * Get an order by ID.
     *
     * @return array<string, mixed>
     */
    public function getOrder(string $id): array
    {
        return $this->request('GET', "/orders/{$id}");
    }

    // ── Current User ───────────────────────────────────────

    /**
     * Get the current authenticated user (merchant).
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/merchants/me');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to Square.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Square access token is not configured.');
        }

        try {
            $http = Http::withToken($this->accessToken)
                ->withHeaders([
                    'Square-Version' => '2024-12-18',
                ])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get(self::BASE_URL . $path, $data),
                'POST' => $http->post(self::BASE_URL . $path, $data),
                'PUT' => $http->put(self::BASE_URL . $path, $data),
                'PATCH' => $http->patch(self::BASE_URL . $path, $data),
                'DELETE' => $http->delete(self::BASE_URL . $path, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $json = $response->json() ?? [];

            if (! $response->successful()) {
                $errors = $json['errors'] ?? [];
                $errorMessages = array_map(function (array $e) {
                    $category = $e['category'] ?? '';
                    $detail = $e['detail'] ?? ($e['message'] ?? 'Unknown error');
                    $code = $e['code'] ?? '';

                    $msg = $detail;
                    if ($code) {
                        $msg .= " (code: {$code})";
                    }

                    return $msg;
                }, $errors);

                $combined = ! empty($errorMessages)
                    ? implode('; ', $errorMessages)
                    : $response->body();

                Log::error("Square API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'errors' => $errors,
                ]);

                throw new \RuntimeException('Square API error (' . $response->status() . '): ' . $combined);
            }

            return $json;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Square API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Square API: {$e->getMessage()}");
        }
    }
}
