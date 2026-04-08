<?php

namespace OpenCompany\Integrations\Brevo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BrevoService
{
    private string $baseUrl = 'https://api.brevo.com/v3';

    public function __construct(
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the Brevo service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List contacts with optional filtering and pagination.
     *
     * @param  array  $params  Query parameters (limit, offset, email, etc.)
     * @return array The parsed JSON response from Brevo.
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a contact's details by their email address.
     *
     * @param  string  $email  The contact's email address (used as the identifier).
     * @return array The parsed JSON response from Brevo.
     */
    public function getContact(string $email): array
    {
        return $this->request('GET', '/contacts/' . urlencode($email));
    }

    /**
     * Create a new contact in Brevo.
     *
     * @param  array  $data  Contact data (email, attributes, listIds, etc.)
     * @return array The parsed JSON response from Brevo.
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts', $data);
    }

    /**
     * List all contact lists with optional pagination.
     *
     * @param  array  $params  Query parameters (limit, offset, etc.)
     * @return array The parsed JSON response from Brevo.
     */
    public function listLists(array $params = []): array
    {
        return $this->request('GET', '/contacts/lists', $params);
    }

    /**
     * Get details of a specific contact list.
     *
     * @param  int  $id  The list ID.
     * @return array The parsed JSON response from Brevo.
     */
    public function getList(int $id): array
    {
        return $this->request('GET', '/contacts/lists/' . $id);
    }

    /**
     * Send a transactional email via the SMTP API.
     *
     * @param  array  $data  Email payload (sender, to, subject, htmlContent, etc.)
     * @return array The parsed JSON response from Brevo.
     */
    public function sendEmail(array $data): array
    {
        return $this->request('POST', '/smtp/email', $data);
    }

    /**
     * Get account information. Useful for testing the connection.
     *
     * @return array The parsed JSON response from Brevo.
     */
    public function getAccount(): array
    {
        return $this->request('GET', '/account');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/contacts").
     * @param  array   $data    Query parameters (GET) or JSON body (POST/PUT).
     * @return array The parsed JSON response body.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Brevo API.
     *
     * Brevo authenticates via the `api-key` header (not Bearer auth).
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Brevo API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
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

                Log::error("Brevo API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Brevo API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Brevo API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Brevo API: {$e->getMessage()}");
        }
    }
}
