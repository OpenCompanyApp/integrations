<?php

namespace OpenCompany\Integrations\ChartMogul;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the ChartMogul API.
 *
 * Handles Basic authentication, request dispatch, error parsing, and endpoint
 * mapping for subscription analytics tools.
 */
class ChartMogulService
{
    /**
     * Create a new ChartMogul API client.
     *
     * @param  string  $apiKey       ChartMogul API key used as the Basic Auth username.
     * @param  string  $baseUrl      ChartMogul API base URL.
     * @param  string  $apiPassword  Optional Basic Auth password; ChartMogul allows this to be empty or equal to the API key.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.chartmogul.com',
        private string $apiPassword = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Determine whether the API key is configured.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Verify credentials with ChartMogul's authenticated ping endpoint.
     *
     * @return array<string, mixed>
     */
    public function ping(): array
    {
        return $this->request('GET', '/v1/ping');
    }

    /**
     * List customers with optional filtering and cursor pagination.
     *
     * @param  int  $perPage  Number of results per page (max 200).
     * @param  string|null  $cursor  Cursor returned by a previous response.
     * @param  string|null  $status  Filter by customer status.
     * @param  string|null  $email  Filter by exact customer email.
     * @param  string|null  $dataSourceUuid  Filter by ChartMogul data source UUID.
     * @param  string|null  $externalId  Filter by customer external ID.
     * @param  string|null  $system  Filter by billing system name.
     * @return array<string, mixed>
     */
    public function listCustomers(
        int $perPage = 50,
        ?string $cursor = null,
        ?string $status = null,
        ?string $email = null,
        ?string $dataSourceUuid = null,
        ?string $externalId = null,
        ?string $system = null,
    ): array {
        $params = $this->cursorParams($perPage, $cursor);

        foreach ([
            'status' => $status,
            'email' => $email,
            'data_source_uuid' => $dataSourceUuid,
            'external_id' => $externalId,
            'system' => $system,
        ] as $key => $value) {
            if ($value !== null && $value !== '') {
                $params[$key] = $value;
            }
        }

        return $this->request('GET', '/v1/customers', $params);
    }

    /**
     * Get a single customer by UUID.
     *
     * @param  string  $uuid  The customer UUID.
     * @return array<string, mixed>
     */
    public function getCustomer(string $uuid): array
    {
        return $this->request('GET', '/v1/customers/' . rawurlencode($uuid));
    }

    /**
     * List subscriptions for a specific customer.
     *
     * @param  string  $customerUuid  ChartMogul customer UUID.
     * @param  int  $perPage  Number of results per page (max 200).
     * @param  string|null  $cursor  Cursor returned by a previous response.
     * @return array<string, mixed>
     */
    public function listSubscriptions(string $customerUuid, int $perPage = 50, ?string $cursor = null): array
    {
        return $this->request(
            'GET',
            '/v1/customers/' . rawurlencode($customerUuid) . '/subscriptions',
            $this->cursorParams($perPage, $cursor),
        );
    }

    /**
     * List plans with optional filters and cursor pagination.
     *
     * @param  int  $perPage  Number of results per page (max 200).
     * @param  string|null  $cursor  Cursor returned by a previous response.
     * @param  string|null  $dataSourceUuid  Filter by data source UUID.
     * @return array<string, mixed>
     */
    public function listPlans(int $perPage = 50, ?string $cursor = null, ?string $dataSourceUuid = null): array
    {
        $params = $this->cursorParams($perPage, $cursor);

        if ($dataSourceUuid !== null && $dataSourceUuid !== '') {
            $params['data_source_uuid'] = $dataSourceUuid;
        }

        return $this->request('GET', '/v1/plans', $params);
    }

    /**
     * List invoices created using the ChartMogul API.
     *
     * @param  int  $perPage  Number of results per page (max 200).
     * @param  string|null  $cursor  Cursor returned by a previous response.
     * @param  string|null  $customerUuid  Filter by customer UUID.
     * @param  string|null  $externalId  Filter by invoice external ID.
     * @return array<string, mixed>
     */
    public function listInvoices(int $perPage = 50, ?string $cursor = null, ?string $customerUuid = null, ?string $externalId = null): array
    {
        $params = $this->cursorParams($perPage, $cursor);

        foreach (['customer_uuid' => $customerUuid, 'external_id' => $externalId] as $key => $value) {
            if ($value !== null && $value !== '') {
                $params[$key] = $value;
            }
        }

        return $this->request('GET', '/v1/invoices', $params);
    }

    /**
     * Get analytics metrics from ChartMogul.
     *
     * @param  string  $startDate  Start date (ISO 8601, e.g. 2026-01-01).
     * @param  string  $endDate  End date (ISO 8601, e.g. 2026-01-31).
     * @param  string  $interval  Interval: day, week, month, quarter, or year.
     * @param  string|null  $geo  Comma-separated ISO 3166-1 alpha-2 country codes.
     * @param  string|null  $plans  Comma-separated plan UUIDs, external IDs, or names.
     * @param  string|null  $filters  ChartMogul advanced filter expression.
     * @return array<string, mixed>
     */
    public function getMetrics(
        string $startDate,
        string $endDate,
        string $interval = 'month',
        ?string $geo = null,
        ?string $plans = null,
        ?string $filters = null,
    ): array {
        $params = [
            'start-date' => $startDate,
            'end-date' => $endDate,
            'interval' => $interval,
        ];

        foreach (['geo' => $geo, 'plans' => $plans, 'filters' => $filters] as $key => $value) {
            if ($value !== null && $value !== '') {
                $params[$key] = $value;
            }
        }

        return $this->request('GET', '/v1/metrics/all', $params);
    }

    /**
     * Backward-compatible alias for the ping endpoint.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->ping();
    }

    /**
     * Build cursor pagination parameters.
     *
     * @param  int  $perPage
     * @param  string|null  $cursor
     * @return array<string, mixed>
     */
    private function cursorParams(int $perPage, ?string $cursor): array
    {
        $params = ['per_page' => max(1, min($perPage, 200))];

        if ($cursor !== null && $cursor !== '') {
            $params['cursor'] = $cursor;
        }

        return $params;
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
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
     * @return Response
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('ChartMogul API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::acceptJson()
                ->asJson()
                ->withBasicAuth($this->apiKey, $this->apiPassword)
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("ChartMogul API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);

                    throw new RuntimeException("ChartMogul API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;

                Log::error("ChartMogul API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('ChartMogul API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("ChartMogul API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to ChartMogul API: {$e->getMessage()}");
        }
    }
}
