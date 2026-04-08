<?php

namespace OpenCompany\Integrations\Paystack;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaystackService
{
    private string $baseUrl = 'https://api.paystack.co';

    public function __construct(
        private string $secretKey = '',
    ) {}

    /**
     * Check whether the Paystack integration is configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->secretKey);
    }

    /**
     * List transactions with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, page, status, customer, from, to).
     * @return array<string, mixed>
     */
    public function listTransactions(array $params = []): array
    {
        return $this->request('GET', '/transaction', $params);
    }

    /**
     * Get a single transaction by ID or reference.
     *
     * @param  string  $id  Transaction ID or reference.
     * @return array<string, mixed>
     */
    public function getTransaction(string $id): array
    {
        return $this->request('GET', '/transaction/' . urlencode($id));
    }

    /**
     * Initialize a new transaction.
     *
     * @param  array<string, mixed>  $data  Transaction data (amount, email, reference, callback_url, etc.).
     * @return array<string, mixed>
     */
    public function initializeTransaction(array $data): array
    {
        return $this->request('POST', '/transaction/initialize', $data);
    }

    /**
     * List customers with optional pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, page).
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customer', $params);
    }

    /**
     * Create a new customer.
     *
     * @param  array<string, mixed>  $data  Customer data (email, first_name, last_name, phone).
     * @return array<string, mixed>
     */
    public function createCustomer(array $data): array
    {
        return $this->request('POST', '/customer', $data);
    }

    /**
     * List plans with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (per_page, page, status).
     * @return array<string, mixed>
     */
    public function listPlans(array $params = []): array
    {
        return $this->request('GET', '/plan', $params);
    }

    /**
     * Check the health/connectivity of the Paystack API.
     *
     * @return array<string, mixed>
     */
    public function getHealth(): array
    {
        return $this->request('GET', '/integration/payment_session_timeout');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Paystack API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->secretKey) {
            throw new \RuntimeException('Paystack secret key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
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
                    Log::warning("Paystack API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Paystack API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is down.");
                }

                $error = $response->json('message') ?? $body;
                Log::error("Paystack API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Paystack API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Paystack API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Paystack API: {$e->getMessage()}");
        }
    }
}
