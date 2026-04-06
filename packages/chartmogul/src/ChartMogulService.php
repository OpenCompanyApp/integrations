<?php

namespace OpenCompany\Integrations\ChartMogul;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChartMogulService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.chartmogul.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List customers with optional filtering and pagination.
     *
     * @param  int  $perPage  Number of results per page (max 200).
     * @param  int  $page  Page number (starting from 1).
     * @param  string|null  $status  Filter by customer status (e.g. "Active", "Cancelled").
     * @param  string|null  $email  Filter by customer email.
     * @return array<string, mixed>
     */
    public function listCustomers(int $perPage = 50, int $page = 1, ?string $status = null, ?string $email = null): array
    {
        $params = [
            'per_page' => $perPage,
            'page' => $page,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        if ($email !== null) {
            $params['email'] = $email;
        }

        return $this->request('GET', '/v1/customers', $params);
    }

    /**
     * Get a single customer by UUID.
     *
     * @param  string  $id  The customer UUID.
     * @return array<string, mixed>
     */
    public function getCustomer(string $id): array
    {
        return $this->request('GET', '/v1/customers/' . urlencode($id));
    }

    /**
     * List subscriptions with optional filtering and pagination.
     *
     * @param  int  $perPage  Number of results per page (max 200).
     * @param  int  $page  Page number (starting from 1).
     * @param  string|null  $customerUuid  Filter by customer UUID.
     * @param  string|null  $status  Filter by subscription status (e.g. "active", "cancelled").
     * @return array<string, mixed>
     */
    public function listSubscriptions(int $perPage = 50, int $page = 1, ?string $customerUuid = null, ?string $status = null): array
    {
        $params = [
            'per_page' => $perPage,
            'page' => $page,
        ];

        if ($customerUuid !== null) {
            $params['customer_uuid'] = $customerUuid;
        }

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/v1/subscriptions', $params);
    }

    /**
     * List plans with optional pagination.
     *
     * @param  int  $perPage  Number of results per page (max 200).
     * @param  int  $page  Page number (starting from 1).
     * @return array<string, mixed>
     */
    public function listPlans(int $perPage = 50, int $page = 1): array
    {
        return $this->request('GET', '/v1/plans', [
            'per_page' => $perPage,
            'page' => $page,
        ]);
    }

    /**
     * List invoices with optional filtering and pagination.
     *
     * @param  int  $perPage  Number of results per page (max 200).
     * @param  int  $page  Page number (starting from 1).
     * @param  string|null  $customerUuid  Filter by customer UUID.
     * @return array<string, mixed>
     */
    public function listInvoices(int $perPage = 50, int $page = 1, ?string $customerUuid = null): array
    {
        $params = [
            'per_page' => $perPage,
            'page' => $page,
        ];

        if ($customerUuid !== null) {
            $params['customer_uuid'] = $customerUuid;
        }

        return $this->request('GET', '/v1/invoices', $params);
    }

    /**
     * Get analytics metrics from ChartMogul.
     *
     * @param  string  $startDate  Start date (ISO 8601, e.g. "2025-01-01").
     * @param  string  $endDate  End date (ISO 8601, e.g. "2025-01-31").
     * @param  string  $interval  Interval for the metrics: "day", "week", "month".
     * @param  string|null  $type  Type of metrics (e.g. "absolute", "percentage").
     * @return array<string, mixed>
     */
    public function getMetrics(string $startDate, string $endDate, string $interval = 'month', ?string $type = null): array
    {
        $params = [
            'start-date' => $startDate,
            'end-date' => $endDate,
            'interval' => $interval,
        ];

        if ($type !== null) {
            $params['type'] = $type;
        }

        return $this->request('GET', '/v1/metrics/all', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the ChartMogul API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('ChartMogul API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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
                    Log::warning("ChartMogul API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("ChartMogul API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("ChartMogul API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("ChartMogul API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ChartMogul API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ChartMogul API: {$e->getMessage()}");
        }
    }
}
