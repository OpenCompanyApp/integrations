<?php

namespace OpenCompany\Integrations\Square;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SquareService
{
    /**
     * Create a new Square API service instance.
     *
     * @param  string  $accessToken  Square OAuth or personal access token
     * @param  string  $baseUrl  Square API base URL (default: https://connect.squareup.com/v2)
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://connect.squareup.com/v2',
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
     * List payments with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, cursor, begin_time, end_time, location_id, status)
     * @return array<string, mixed>
     */
    public function listPayments(array $params = []): array
    {
        return $this->request('GET', '/payments', $params);
    }

    /**
     * Get a single payment by ID.
     *
     * @param  string  $id  The Square payment ID
     * @return array<string, mixed>
     */
    public function getPayment(string $id): array
    {
        return $this->request('GET', '/payments/' . urlencode($id));
    }

    /**
     * Create a new payment.
     *
     * @param  array<string, mixed>  $data  Payment data including source_id, idempotency_key, and amount_money
     * @return array<string, mixed>
     */
    public function createPayment(array $data): array
    {
        return $this->request('POST', '/payments', $data);
    }

    /**
     * List customers with optional pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, cursor)
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers', $params);
    }

    /**
     * Create a new customer.
     *
     * @param  array<string, mixed>  $data  Customer data including given_name, family_name, email_address, phone_number
     * @return array<string, mixed>
     */
    public function createCustomer(array $data): array
    {
        return $this->request('POST', '/customers', $data);
    }

    /**
     * List all business locations.
     *
     * @return array<string, mixed>
     */
    public function listLocations(): array
    {
        return $this->request('GET', '/locations');
    }

    /**
     * Get the current user / health check via the locations endpoint.
     *
     * Returns the name of the first location as a simple connectivity check.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        $result = $this->listLocations();
        $locations = $result['locations'] ?? [];

        if (!empty($locations)) {
            return [
                'connected' => true,
                'location_name' => $locations[0]['name'] ?? 'Unknown',
                'location_count' => count($locations),
            ];
        }

        return [
            'connected' => true,
            'location_name' => null,
            'location_count' => 0,
        ];
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Query or body parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Square API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Query or body parameters
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Square access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Square-Version' => '2024-12-18',
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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Square API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Square API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may require different permissions or the URL may be incorrect.");
                }

                $json = $response->json();
                $errors = $json['errors'] ?? [];
                $errorMessages = array_map(fn (array $e) => ($e['category'] ?? '') . ': ' . ($e['detail'] ?? $e['message'] ?? 'Unknown error'), $errors);
                $error = !empty($errorMessages) ? implode('; ', $errorMessages) : $body;

                Log::error("Square API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Square API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Square API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Square API: {$e->getMessage()}");
        }
    }
}
