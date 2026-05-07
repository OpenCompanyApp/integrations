<?php

namespace OpenCompany\Integrations\Razorpay;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Razorpay API service for interacting with the Razorpay v1 REST API.
 *
 * Handles authentication via HTTP Basic Auth (key_id:key_secret) and provides
 * methods for payments, orders, refunds, and customers.
 */
class RazorpayService
{
    /**
     * Create a new RazorpayService instance.
     *
     * @param  string  $keyId     The Razorpay Key ID.
     * @param  string  $keySecret The Razorpay Key Secret.
     * @param  string  $baseUrl   The base URL for the Razorpay API (default: https://api.razorpay.com/v1).
     */
    public function __construct(
        private string $keyId = '',
        private string $keySecret = '',
        private string $baseUrl = 'https://api.razorpay.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->keyId) && !empty($this->keySecret);
    }

    /**
     * List payments from Razorpay.
     *
     * @param  array<string, mixed>  $params  Optional query parameters (e.g., count, skip, from, to).
     * @return array<string, mixed>
     */
    public function listPayments(array $params = []): array
    {
        return $this->request('GET', '/payments', $params);
    }

    /**
     * Get a single payment by ID.
     *
     * @param  string  $paymentId  The Razorpay payment ID.
     * @return array<string, mixed>
     */
    public function getPayment(string $paymentId): array
    {
        return $this->request('GET', '/payments/' . urlencode($paymentId));
    }

    /**
     * List orders from Razorpay.
     *
     * @param  array<string, mixed>  $params  Optional query parameters (e.g., count, skip, from, to).
     * @return array<string, mixed>
     */
    public function listOrders(array $params = []): array
    {
        return $this->request('GET', '/orders', $params);
    }

    /**
     * Get a single order by ID.
     *
     * @param  string  $orderId  The Razorpay order ID.
     * @return array<string, mixed>
     */
    public function getOrder(string $orderId): array
    {
        return $this->request('GET', '/orders/' . urlencode($orderId));
    }

    /**
     * Create a new order in Razorpay.
     *
     * @param  int     $amount    Amount in the smallest currency unit (e.g., paise for INR).
     * @param  string  $currency  Three-letter currency code (e.g., "INR").
     * @param  string  $receipt   Your internal receipt identifier.
     * @param  array<string, mixed>  $extra  Additional optional parameters (e.g., notes, partial_payment).
     * @return array<string, mixed>
     */
    public function createOrder(int $amount, string $currency = 'INR', string $receipt = '', array $extra = []): array
    {
        $data = array_merge([
            'amount' => $amount,
            'currency' => $currency,
            'receipt' => $receipt,
        ], $extra);

        return $this->request('POST', '/orders', $data);
    }

    /**
     * List refunds from Razorpay.
     *
     * @param  array<string, mixed>  $params  Optional query parameters (e.g., count, skip).
     * @return array<string, mixed>
     */
    public function listRefunds(array $params = []): array
    {
        return $this->request('GET', '/refunds', $params);
    }

    /**
     * List customers from Razorpay.
     *
     * @param  array<string, mixed>  $params  Optional query parameters (e.g., count, skip).
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers', $params);
    }

    /**
     * Check the configured Razorpay credentials with a lightweight payments call.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/payments', ['count' => 1]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Razorpay API.
     *
     * Uses HTTP Basic Authentication with the key_id and key_secret.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If credentials are missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->keyId || !$this->keySecret) {
            throw new \RuntimeException('Razorpay API credentials (key_id and key_secret) are not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->keyId, $this->keySecret)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Razorpay API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Razorpay API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or unavailable.");
                }

                $error = $response->json('error.description') ?? $response->json('error') ?? $body;
                Log::error("Razorpay API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Razorpay API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Razorpay API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Razorpay API: {$e->getMessage()}");
        }
    }
}
