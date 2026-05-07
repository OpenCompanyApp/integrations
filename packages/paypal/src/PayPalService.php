<?php

namespace OpenCompany\Integrations\PayPal;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * PayPal API service for communicating with the PayPal REST API.
 *
 * Handles authentication via Bearer tokens and provides methods for
 * Orders v2, legacy Payments v1, Invoicing v2, and user identity endpoints.
 */
class PayPalService
{
    /**
     * Create a new PayPal service instance.
     *
     * @param  string  $accessToken  The PayPal API access token.
     * @param  string  $baseUrl  The PayPal API host URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api-m.paypal.com',
    ) {
        $this->baseUrl = preg_replace('~/v[12]$~', '', rtrim($this->baseUrl, '/')) ?: rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the PayPal integration is configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get a checkout order by ID.
     *
     * @param  string  $orderId  The PayPal order ID.
     * @return array<string, mixed>
     */
    public function getOrder(string $orderId): array
    {
        return $this->request('GET', '/v2/checkout/orders/' . urlencode($orderId));
    }

    /**
     * Create a new checkout order.
     *
     * @param  array<string, mixed>  $body  The order creation payload.
     * @return array<string, mixed>
     */
    public function createOrder(array $body): array
    {
        return $this->request('POST', '/v2/checkout/orders', $body);
    }

    /**
     * Capture a previously approved checkout order.
     *
     * @param  string  $orderId  The PayPal order ID.
     * @param  array<string, mixed>  $body  Optional capture request payload.
     * @return array<string, mixed>
     */
    public function captureOrder(string $orderId, array $body = []): array
    {
        return $this->request('POST', '/v2/checkout/orders/' . urlencode($orderId) . '/capture', $body);
    }

    /**
     * List payments.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., count, start_id).
     * @return array<string, mixed>
     */
    public function listPayments(array $params = []): array
    {
        return $this->request('GET', '/v1/payments/payment', $params);
    }

    /**
     * Get a payment by ID.
     *
     * @param  string  $paymentId  The PayPal payment ID.
     * @return array<string, mixed>
     */
    public function getPayment(string $paymentId): array
    {
        return $this->request('GET', '/v1/payments/payment/' . urlencode($paymentId));
    }

    /**
     * List invoices.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., page, page_size, total_required).
     * @return array<string, mixed>
     */
    public function listInvoices(array $params = []): array
    {
        return $this->request('GET', '/v2/invoicing/invoices', $params);
    }

    /**
     * Get the current authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/identity/oauth2/userinfo');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path   API path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the PayPal API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path   API path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('PayPal access token is not configured.');
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
                    Log::warning("PayPal API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("PayPal API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("PayPal API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("PayPal API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("PayPal API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to PayPal API: {$e->getMessage()}");
        }
    }
}
