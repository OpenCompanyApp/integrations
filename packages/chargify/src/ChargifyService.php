<?php

namespace OpenCompany\Integrations\Chargify;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChargifyService
{
    public function __construct(
        private string $apiKey = '',
        private string $subdomain = '',
        private string $baseUrl = '',
    ) {
        if ($this->baseUrl === '' && $this->subdomain !== '') {
            $this->baseUrl = 'https://' . $this->subdomain . '.chargify.com';
        }
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->baseUrl);
    }

    /**
     * List subscriptions.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page (max 200).
     * @param  string|null  $state  Filter by state: active, past_due, canceled, expired, trial, etc.
     * @return array<string, mixed>
     */
    public function listSubscriptions(int $page = 1, int $perPage = 20, ?string $state = null): array
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];
        if ($state !== null) {
            $params['state'] = $state;
        }

        return $this->request('GET', '/subscriptions.json', $params);
    }

    /**
     * Get a single subscription by ID.
     *
     * @param  int  $subscriptionId  The Chargify subscription ID.
     * @return array<string, mixed>
     */
    public function getSubscription(int $subscriptionId): array
    {
        return $this->request('GET', '/subscriptions/' . $subscriptionId . '.json');
    }

    /**
     * List customers.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page (max 200).
     * @return array<string, mixed>
     */
    public function listCustomers(int $page = 1, int $perPage = 20): array
    {
        return $this->request('GET', '/customers.json', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get a single customer by ID.
     *
     * @param  int  $customerId  The Chargify customer ID.
     * @return array<string, mixed>
     */
    public function getCustomer(int $customerId): array
    {
        return $this->request('GET', '/customers/' . $customerId . '.json');
    }

    /**
     * List products.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page (max 200).
     * @return array<string, mixed>
     */
    public function listProducts(int $page = 1, int $perPage = 20): array
    {
        return $this->request('GET', '/products.json', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * List invoices.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page (max 200).
     * @param  string|null  $status  Filter by status: open, paid, pending, voided.
     * @return array<string, mixed>
     */
    public function listInvoices(int $page = 1, int $perPage = 20, ?string $status = null): array
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/invoices.json', $params);
    }

    /**
     * Get the currently authenticated user.
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
     * Make a raw HTTP request to the Chargify API.
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
        if (!$this->apiKey) {
            throw new \RuntimeException('Chargify API key is not configured.');
        }

        if (!$this->baseUrl) {
            throw new \RuntimeException('Chargify subdomain/base URL is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Auth-Token' => $this->apiKey,
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
                    Log::warning("Chargify API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Chargify API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the subdomain may be wrong.");
                }

                $error = $response->json('error') ?? $response->json('errors') ?? $body;
                Log::error("Chargify API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Chargify API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Chargify API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Chargify API: {$e->getMessage()}");
        }
    }
}
