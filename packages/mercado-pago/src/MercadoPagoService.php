<?php

namespace OpenCompany\Integrations\MercadoPago;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MercadoPagoService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.mercadopago.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Search/payments endpoint — list payments with optional filters.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listPayments(array $params = []): array
    {
        return $this->request('GET', '/payments/search', $params);
    }

    /**
     * Get a single payment by its ID.
     *
     * @return array<string, mixed>
     */
    public function getPayment(string $paymentId): array
    {
        return $this->request('GET', '/payments/' . urlencode($paymentId));
    }

    /**
     * Create a new payment.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createPayment(array $data): array
    {
        return $this->request('POST', '/payments', $data);
    }

    /**
     * Search customers with optional filters.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers/search', $params);
    }

    /**
     * Get a single customer by their ID.
     *
     * @return array<string, mixed>
     */
    public function getCustomer(string $customerId): array
    {
        return $this->request('GET', '/customers/' . urlencode($customerId));
    }

    /**
     * List checkout preferences.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listPreferences(array $params = []): array
    {
        return $this->request('GET', '/checkout/preferences', $params);
    }

    /**
     * Get the current authenticated user's information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Mercado Pago API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Mercado Pago access token is not configured.');
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
                $error = $response->json('message') ?? $response->body();

                Log::error("Mercado Pago API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Mercado Pago API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mercado Pago API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Mercado Pago API: {$e->getMessage()}");
        }
    }
}
