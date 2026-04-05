<?php

namespace OpenCompany\Integrations\FreshBooks;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FreshBooksService
{
    public function __construct(
        private string $accessToken = '',
        private string $accountId = '',
        private string $baseUrl = 'https://api.freshbooks.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->accountId);
    }

    /**
     * Get the configured account ID.
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * List invoices for the configured account.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., search, page, per_page).
     * @return array<string, mixed>
     */
    public function listInvoices(array $params = []): array
    {
        return $this->request('GET', "/accounting/account/{$this->accountId}/invoices/invoices", $params);
    }

    /**
     * Get a single invoice by ID.
     *
     * @return array<string, mixed>
     */
    public function getInvoice(int $invoiceId): array
    {
        return $this->request('GET', "/accounting/account/{$this->accountId}/invoices/invoices/{$invoiceId}");
    }

    /**
     * Create a new invoice.
     *
     * @param  array<string, mixed>  $data  Invoice payload.
     * @return array<string, mixed>
     */
    public function createInvoice(array $data): array
    {
        return $this->request('POST', "/accounting/account/{$this->accountId}/invoices/invoices", $data);
    }

    /**
     * List clients for the configured account.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listClients(array $params = []): array
    {
        return $this->request('GET', "/accounting/account/{$this->accountId}/users/clients", $params);
    }

    /**
     * Get a single client by ID.
     *
     * @return array<string, mixed>
     */
    public function getClient(int $clientId): array
    {
        return $this->request('GET', "/accounting/account/{$this->accountId}/users/clients/{$clientId}");
    }

    /**
     * List projects for the configured account.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', "/projects/account/{$this->accountId}/projects", $params);
    }

    /**
     * List payments for the configured account.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listPayments(array $params = []): array
    {
        return $this->request('GET', "/accounting/account/{$this->accountId}/payments/payments", $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/auth/api/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (appended to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the FreshBooks API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('FreshBooks access token is not configured.');
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
                    Log::warning("FreshBooks API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("FreshBooks API endpoint not available (HTTP {$response->status()}). Check the URL and account ID.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("FreshBooks API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("FreshBooks API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("FreshBooks API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to FreshBooks API: {$e->getMessage()}");
        }
    }
}
