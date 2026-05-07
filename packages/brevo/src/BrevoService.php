<?php

namespace OpenCompany\Integrations\Brevo;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Brevo API v3.
 *
 * Handles api-key authentication, request dispatch, error logging, and
 * response parsing for all Brevo tools.
 */
class BrevoService
{
    /**
     * @param  string  $apiKey  Brevo API key.
     * @param  string  $baseUrl  Brevo API v3 base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.brevo.com/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Get account information.
     *
     * @return array<string, mixed>
     */
    public function getAccount(): array
    {
        return $this->apiGet('/account');
    }

    /**
     * List contacts.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->apiGet('/contacts', $params);
    }

    /**
     * Get a contact by email, SMS, WhatsApp number, or external identifier.
     *
     * @return array<string, mixed>
     */
    public function getContact(string $identifier): array
    {
        return $this->apiGet('/contacts/' . rawurlencode($identifier));
    }

    /**
     * Create a contact.
     *
     * @param  array<string, mixed>  $data  Contact body.
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->apiPost('/contacts', $data);
    }

    /**
     * List contact lists.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listLists(array $params = []): array
    {
        return $this->apiGet('/contacts/lists', $params);
    }

    /**
     * Get a contact list.
     *
     * @return array<string, mixed>
     */
    public function getList(int $id): array
    {
        return $this->apiGet('/contacts/lists/' . $id);
    }

    /**
     * Send a transactional email.
     *
     * @param  array<string, mixed>  $data  Email payload.
     * @return array<string, mixed>
     */
    public function sendEmail(array $data): array
    {
        return $this->apiPost('/smtp/email', $data);
    }

    /**
     * Send a GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Send a POST request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $data = [], array $query = []): array
    {
        return $this->request('POST', $path, $data, $query);
    }

    /**
     * Send a PUT request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $data = [], array $query = []): array
    {
        return $this->request('PUT', $path, $data, $query);
    }

    /**
     * Send a PATCH request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $data = [], array $query = []): array
    {
        return $this->request('PATCH', $path, $data, $query);
    }

    /**
     * Send a DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, $query);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query params for GET/DELETE or JSON body for mutating requests.
     * @param  array<string, mixed>  $query  Query params for mutating requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $query);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to Brevo.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): Response
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('Brevo API key is not configured.');
        }

        $url = $this->baseUrl . '/' . ltrim($path, '/');

        try {
            $http = Http::withHeaders(['api-key' => $this->apiKey])
                ->acceptJson()
                ->asJson()
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->withOptions(['query' => $query])->post($url, $data),
                'PUT' => $http->withOptions(['query' => $query])->put($url, $data),
                'PATCH' => $http->withOptions(['query' => $query])->patch($url, $data),
                'DELETE' => $http->withOptions(['query' => $data])->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();

                Log::error("Brevo API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('Brevo API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Brevo API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Brevo API: {$e->getMessage()}");
        }
    }
}
