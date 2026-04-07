<?php

namespace OpenCompany\Integrations\Avalara;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AvalaraService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.avalara.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->baseUrl);
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    public function listTransactions(?int $top = null, ?int $skip = null, ?string $filter = null, ?string $orderBy = null): array
    {
        $params = [];
        if ($top !== null) { $params['$top'] = $top; }
        if ($skip !== null) { $params['$skip'] = $skip; }
        if ($filter !== null) { $params['$filter'] = $filter; }
        if ($orderBy !== null) { $params['$orderBy'] = $orderBy; }
        return $this->request('GET', '/transactions', $params);
    }

    public function getTransaction(string $id): array
    {
        return $this->request('GET', '/transactions/' . urlencode($id));
    }

    public function createTransaction(array $data): array
    {
        return $this->request('POST', '/transactions', $data);
    }

    public function listCompanies(?int $top = null, ?int $skip = null, ?string $filter = null): array
    {
        $params = [];
        if ($top !== null) { $params['$top'] = $top; }
        if ($skip !== null) { $params['$skip'] = $skip; }
        if ($filter !== null) { $params['$filter'] = $filter; }
        return $this->request('GET', '/companies', $params);
    }

    public function getCompany(string $id): array
    {
        return $this->request('GET', '/companies/' . urlencode($id));
    }

    public function listTaxCodes(?int $top = null, ?int $skip = null, ?string $filter = null): array
    {
        $params = [];
        if ($top !== null) { $params['$top'] = $top; }
        if ($skip !== null) { $params['$skip'] = $skip; }
        if ($filter !== null) { $params['$filter'] = $filter; }
        return $this->request('GET', '/taxcodes', $params);
    }

    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        if ($response->status() === 204) { return []; }
        return $response->json() ?? [];
    }

    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken || !$this->baseUrl) {
            throw new \RuntimeException('Avalara access token is not configured.');
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
                Log::error("Avalara API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Avalara API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Avalara API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Avalara API: {$e->getMessage()}");
        }
    }
}
