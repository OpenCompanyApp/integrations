<?php

namespace OpenCompany\Integrations\Loops;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoopsService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://app.loops.so/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    /**
     * List contacts with optional pagination.
     *
     * @return array<string, mixed>
     */
    public function listContacts(int $limit = 50, int $offset = 0): array
    {
        return $this->request('GET', '/contacts', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single contact by ID.
     *
     * @return array<string, mixed>
     */
    public function getContact(string $contactId): array
    {
        return $this->request('GET', '/contacts/' . urlencode($contactId));
    }

    /**
     * Create a new contact.
     *
     * @return array<string, mixed>
     */
    public function createContact(string $email, ?string $firstName = null, ?string $lastName = null): array
    {
        $data = ['email' => $email];

        if ($firstName !== null) {
            $data['first_name'] = $firstName;
        }

        if ($lastName !== null) {
            $data['last_name'] = $lastName;
        }

        return $this->request('POST', '/contacts', $data);
    }

    /**
     * Update an existing contact.
     *
     * @param  array<string, mixed>  $fields
     * @return array<string, mixed>
     */
    public function updateContact(string $contactId, array $fields): array
    {
        return $this->request('PUT', '/contacts/' . urlencode($contactId), $fields);
    }

    /**
     * Send a custom event for a contact.
     *
     * @param  array<string, mixed>  $properties
     * @return array<string, mixed>
     */
    public function sendEvent(string $email, string $eventName, array $properties = []): array
    {
        $data = [
            'email' => $email,
            'eventName' => $eventName,
        ];

        if (! empty($properties)) {
            $data['eventProperties'] = $properties;
        }

        return $this->request('POST', '/events', $data);
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
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Loops API.
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Loops API key is not configured.');
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

            if (! $response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("Loops API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException('Loops API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Loops API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('Failed to connect to Loops API: ' . $e->getMessage());
        }
    }
}
