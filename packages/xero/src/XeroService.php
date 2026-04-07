<?php

namespace OpenCompany\Integrations\Xero;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Xero Accounting REST API covering invoices, contacts, and accounts.
 *
 * Wraps the Xero API v2.0 with Bearer token authentication, request routing, and error reporting.
 */
class XeroService
{
    /**
     * @param  string  $accessToken  Xero OAuth2 access token
     * @param  string  $baseUrl      Xero API base URL (default: https://api.xero.com/api.xro/2.0)
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.xero.com/api.xro/2.0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Invoices ───────────────────────────────────────────

    /**
     * List invoices with optional pagination, status filter, and date range.
     *
     * @param  array<string, mixed>  $params  Query params: page, pageSize, statuses, where, order
     * @return array<string, mixed>
     */
    public function listInvoices(array $params = []): array
    {
        return $this->request('GET', '/Invoices', $params);
    }

    /**
     * Get an invoice by ID.
     *
     * @return array<string, mixed>
     */
    public function getInvoice(string $id): array
    {
        return $this->request('GET', "/Invoices/{$id}");
    }

    /**
     * Create an invoice.
     *
     * @param  array<string, mixed>  $data  Invoice fields
     * @return array<string, mixed>
     */
    public function createInvoice(array $data): array
    {
        return $this->request('PUT', '/Invoices', $data);
    }

    // ── Contacts ───────────────────────────────────────────

    /**
     * List contacts with optional pagination and search.
     *
     * @param  array<string, mixed>  $params  Query params: page, pageSize, where, order, includeArchived
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/Contacts', $params);
    }

    /**
     * Get a contact by ID.
     *
     * @return array<string, mixed>
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', "/Contacts/{$id}");
    }

    // ── Accounts ───────────────────────────────────────────

    /**
     * List accounts.
     *
     * @param  array<string, mixed>  $params  Query params: where, order
     * @return array<string, mixed>
     */
    public function listAccounts(array $params = []): array
    {
        return $this->request('GET', '/Accounts', $params);
    }

    // ── Current User ───────────────────────────────────────

    /**
     * Get the current user info via the connections endpoint.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/Users');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (PUT/POST/DELETE)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Xero access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['ErrorNumber'] ?? null;
                $msg = $body['Message'] ?? $body['Type'] ?? $response->body();

                if (isset($body['Elements']) && is_array($body['Elements'])) {
                    $validationErrors = [];
                    foreach ($body['Elements'] as $element) {
                        if (isset($element['ValidationErrors']) && is_array($element['ValidationErrors'])) {
                            foreach ($element['ValidationErrors'] as $ve) {
                                $validationErrors[] = $ve['Message'] ?? json_encode($ve);
                            }
                        }
                    }
                    if (! empty($validationErrors)) {
                        $msg = implode('; ', $validationErrors);
                    }
                }

                Log::error("Xero API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => is_string($msg) ? $msg : json_encode($msg),
                ]);

                $errorMsg = is_string($msg) ? $msg : json_encode($msg);

                throw new \RuntimeException('Xero API error (' . $response->status() . '): ' . $errorMsg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Xero API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Xero API: {$e->getMessage()}");
        }
    }
}
