<?php

namespace OpenCompany\Integrations\Loops;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Loops REST API.
 *
 * Covers contacts, contact properties, mailing lists, events, transactional
 * email, API-key validation, suppression, and sending IP configuration.
 */
class LoopsService
{
    /**
     * @param  string  $apiKey  Loops API key.
     * @param  string  $baseUrl  Loops API v1 base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://app.loops.so/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Create a new contact with any Loops contact properties.
     *
     * @param  array<string, mixed>  $data  Contact fields including email and optional custom properties.
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts/create', $data);
    }

    /**
     * Update or create a contact by email or userId.
     *
     * @param  array<string, mixed>  $data  Contact update fields including email or userId.
     * @return array<string, mixed>
     */
    public function updateContact(array $data): array
    {
        return $this->request('PUT', '/contacts/update', $data);
    }

    /**
     * Find contacts by email address or user ID.
     *
     * @param  array<string, mixed>  $query  Query parameters (email or userId).
     * @return array<string, mixed>
     */
    public function findContact(array $query): array
    {
        return $this->request('GET', '/contacts/find', $this->identityQuery($query));
    }

    /**
     * Delete a contact by email address or user ID.
     *
     * @param  array<string, mixed>  $data  Delete payload (email or userId).
     * @return array<string, mixed>
     */
    public function deleteContact(array $data): array
    {
        return $this->request('POST', '/contacts/delete', $this->identityQuery($data));
    }

    /**
     * Check whether a contact is suppressed.
     *
     * @param  array<string, mixed>  $query  Query parameters (email or userId).
     * @return array<string, mixed>
     */
    public function checkContactSuppression(array $query): array
    {
        return $this->request('GET', '/contacts/suppression', $this->identityQuery($query));
    }

    /**
     * Remove a contact from the suppression list.
     *
     * @param  array<string, mixed>  $query  Query parameters (email or userId).
     * @return array<string, mixed>
     */
    public function removeContactSuppression(array $query): array
    {
        return $this->request('DELETE', '/contacts/suppression', $this->identityQuery($query));
    }

    /**
     * Create a contact property.
     *
     * @param  array<string, mixed>  $data  Property fields (name, type).
     * @return array<string, mixed>
     */
    public function createContactProperty(array $data): array
    {
        return $this->request('POST', '/contacts/properties', $this->onlyKeys($data, ['name', 'type']));
    }

    /**
     * List contact properties.
     *
     * @param  array<string, mixed>  $query  Optional filters supported by Loops.
     * @return array<string, mixed>
     */
    public function listContactProperties(array $query = []): array
    {
        return $this->request('GET', '/contacts/properties', $query);
    }

    /**
     * List mailing lists.
     *
     * @return array<string, mixed>
     */
    public function listMailingLists(): array
    {
        return $this->request('GET', '/lists');
    }

    /**
     * Send an event to Loops.
     *
     * @param  array<string, mixed>  $data  Event payload including eventName and email or userId.
     * @return array<string, mixed>
     */
    public function sendEvent(array $data): array
    {
        return $this->request('POST', '/events/send', $data);
    }

    /**
     * Send a transactional email.
     *
     * @param  array<string, mixed>  $data  Transactional email payload.
     * @param  string|null  $idempotencyKey  Optional idempotency key header.
     * @return array<string, mixed>
     */
    public function sendTransactionalEmail(array $data, ?string $idempotencyKey = null): array
    {
        return $this->request('POST', '/transactional', $data, $idempotencyKey);
    }

    /**
     * List published transactional emails.
     *
     * @param  array<string, mixed>  $query  Pagination query (perPage, cursor).
     * @return array<string, mixed>
     */
    public function listTransactionalEmails(array $query = []): array
    {
        return $this->request('GET', '/transactional', $this->onlyKeys($query, ['perPage', 'cursor']));
    }

    /**
     * Test the configured API key.
     *
     * @return array<string, mixed>
     */
    public function testApiKey(): array
    {
        return $this->request('GET', '/api-key');
    }

    /**
     * List dedicated sending IP addresses.
     *
     * @return array<string, mixed>
     */
    public function listDedicatedSendingIps(): array
    {
        return $this->request('GET', '/dedicated-sending-ips');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @param  string|null  $idempotencyKey  Optional idempotency key header.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], ?string $idempotencyKey = null): array
    {
        $response = $this->rawRequest($method, $path, $data, $idempotencyKey);
        $json = $response->json();

        if (is_array($json)) {
            return $json;
        }

        $body = $response->body();

        return $body === '' ? ['success' => true] : ['response' => $body];
    }

    /**
     * Make a raw HTTP request to the Loops API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @param  string|null  $idempotencyKey  Optional idempotency key header.
     * @return Response
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = [], ?string $idempotencyKey = null): Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('Loops API key is not configured.');
        }

        $url = $this->baseUrl.$path;

        try {
            $headers = [
                'Authorization' => 'Bearer '.$this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            if ($idempotencyKey !== null && $idempotencyKey !== '') {
                $headers['Idempotency-Key'] = $idempotencyKey;
            }

            $http = Http::withHeaders($headers)->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->withOptions(['query' => $data])->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Loops API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException('Failed to connect to Loops API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized API error.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  Response  $response  Failed response.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $error = $response->json('message') ?? $response->json('error') ?? $response->body();

        Log::error("Loops API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException('Loops API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
    }

    /**
     * Keep only identity lookup keys and require one of them.
     *
     * @param  array<string, mixed>  $data  Source data.
     * @return array<string, mixed>
     */
    private function identityQuery(array $data): array
    {
        $query = $this->onlyKeys($data, ['email', 'userId']);

        if (count($query) !== 1) {
            throw new RuntimeException('Provide exactly one of email or userId.');
        }

        return $query;
    }

    /**
     * Keep only supported keys and remove null values.
     *
     * @param  array<string, mixed>  $data  Source data.
     * @param  array<int, string>  $keys  Allowed keys.
     * @return array<string, mixed>
     */
    private function onlyKeys(array $data, array $keys): array
    {
        return array_filter(array_intersect_key($data, array_flip($keys)), static fn (mixed $value): bool => $value !== null);
    }
}
