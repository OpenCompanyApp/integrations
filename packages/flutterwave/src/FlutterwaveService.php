<?php

namespace OpenCompany\Integrations\Flutterwave;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Flutterwave v3 REST API.
 *
 * Handles bearer secret-key authentication, JSON request dispatch, error
 * normalization, and response parsing for Flutterwave tools.
 */
class FlutterwaveService
{
    /**
     * Create a new FlutterwaveService instance.
     *
     * @param  string  $secretKey  The Flutterwave secret key used for Bearer authentication.
     * @param  string  $baseUrl    The base URL for the Flutterwave API (defaults to v3).
     */
    public function __construct(
        private string $secretKey = '',
        private string $baseUrl = 'https://api.flutterwave.com/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Determine whether the service is properly configured with a secret key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->secretKey);
    }

    /**
     * List transactions with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, status, from, to, customer_email, tx_ref, customer_fullname, currency).
     * @return array<string, mixed>
     */
    public function listTransactions(array $params = []): array
    {
        return $this->request('GET', '/transactions', $params);
    }

    /**
     * Retrieve a single transaction by its ID.
     *
     * @param  int|string  $id  The Flutterwave transaction ID.
     * @return array<string, mixed>
     */
    public function getTransaction(int|string $id): array
    {
        return $this->request('GET', '/transactions/' . $id);
    }

    /**
     * Initiate a new payment via the Flutterwave Charge API.
     *
     * @param  array<string, mixed>  $data  Payment payload (tx_ref, amount, currency, customer, etc.).
     * @return array<string, mixed>
     */
    public function initiatePayment(array $data): array
    {
        return $this->request('POST', '/payments', $data);
    }

    /**
     * Verify a transaction by its transaction ID.
     *
     * @param  int|string  $txRef  The transaction ID to verify.
     * @return array<string, mixed>
     */
    public function verifyTransaction(int|string $txRef): array
    {
        return $this->request('GET', '/transactions/' . urlencode((string) $txRef) . '/verify');
    }

    /**
     * List customers with optional pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. page).
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers', $params);
    }

    /**
     * Create a new customer record in Flutterwave.
     *
     * @param  array<string, mixed>  $data  Customer payload (email, first_name, last_name, phone, etc.).
     * @return array<string, mixed>
     */
    public function createCustomer(array $data): array
    {
        return $this->request('POST', '/customers', $data);
    }

    /**
     * Get a list of supported banks for a given country.
     *
     * @param  string  $country  ISO country code (e.g. "NG" for Nigeria).
     * @return array<string, mixed>
     */
    public function getBanks(string $country = 'NG'): array
    {
        return $this->request('GET', '/banks/' . strtoupper($country));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Flutterwave API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->secretKey) {
            throw new \RuntimeException('Flutterwave secret key is not configured.');
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
                $body = $response->body();
                $error = $response->json('message') ?? $body;

                Log::error("Flutterwave API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    "Flutterwave API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Flutterwave API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Flutterwave API: {$e->getMessage()}");
        }
    }
}
