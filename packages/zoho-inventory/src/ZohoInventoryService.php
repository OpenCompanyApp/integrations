<?php

namespace OpenCompany\Integrations\ZohoInventory;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZohoInventoryService
{
    public function __construct(
        private string $accessToken = '',
        private string $organizationId = '',
        private string $baseUrl = 'https://www.zohoapis.com/inventory',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the integration is configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->organizationId);
    }

    /**
     * List items (products) from Zoho Inventory.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page (max 200).
     * @param  string|null  $status  Filter by status: active, inactive, all.
     * @return array<string, mixed>
     */
    public function listItems(int $page = 1, int $perPage = 25, ?string $status = null): array
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/api/v1/items', $params);
    }

    /**
     * Get a single item by ID.
     *
     * @param  string  $id  The Zoho Inventory item ID.
     * @return array<string, mixed>
     */
    public function getItem(string $id): array
    {
        return $this->request('GET', '/api/v1/items/' . urlencode($id));
    }

    /**
     * List sales orders from Zoho Inventory.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page (max 200).
     * @param  string|null  $status  Filter by status: draft, confirmed, void, open, invoiced, partially_invoiced, all.
     * @return array<string, mixed>
     */
    public function listOrders(int $page = 1, int $perPage = 25, ?string $status = null): array
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/api/v1/salesorders', $params);
    }

    /**
     * Get a single sales order by ID.
     *
     * @param  string  $id  The Zoho Inventory sales order ID.
     * @return array<string, mixed>
     */
    public function getOrder(string $id): array
    {
        return $this->request('GET', '/api/v1/salesorders/' . urlencode($id));
    }

    /**
     * List shipments from Zoho Inventory.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page (max 200).
     * @return array<string, mixed>
     */
    public function listShipments(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', '/api/v1/shipments', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * List packages from Zoho Inventory.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page (max 200).
     * @return array<string, mixed>
     */
    public function listPackages(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', '/api/v1/packages', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v1/users/me');
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
     * Make a raw HTTP request to the Zoho Inventory API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Zoho Inventory access token is not configured.');
        }

        if (!$this->organizationId) {
            throw new \RuntimeException('Zoho Inventory organization ID is not configured.');
        }

        // Always include organization_id as a query parameter
        $data['organization_id'] = $this->organizationId;

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
                    Log::warning("Zoho Inventory API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Zoho Inventory API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Zoho Inventory API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Zoho Inventory API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zoho Inventory API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zoho Inventory API: {$e->getMessage()}");
        }
    }
}
