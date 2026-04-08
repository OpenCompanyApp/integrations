<?php

namespace OpenCompany\Integrations\HelpScout;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HelpScoutService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.helpscout.net/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List conversations with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., mailbox, status, page).
     * @return array<string, mixed>
     */
    public function listConversations(array $params = []): array
    {
        return $this->request('GET', '/conversations', $params);
    }

    /**
     * Get a single conversation by ID.
     *
     * @param  int  $id  The conversation ID.
     * @return array<string, mixed>
     */
    public function getConversation(int $id): array
    {
        return $this->request('GET', '/conversations/' . $id);
    }

    /**
     * Create a new conversation.
     *
     * @param  array<string, mixed>  $data  Conversation payload (subject, customer, mailboxId, etc.).
     * @return array<string, mixed>
     */
    public function createConversation(array $data): array
    {
        return $this->request('POST', '/conversations', $data);
    }

    /**
     * Update an existing conversation.
     *
     * @param  int  $id  The conversation ID.
     * @param  array<string, mixed>  $data  Fields to update (status, assignTo, tags, etc.).
     * @return array<string, mixed>
     */
    public function updateConversation(int $id, array $data): array
    {
        return $this->request('PATCH', '/conversations/' . $id, $data);
    }

    /**
     * List customers with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., page, firstName, lastName, email).
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers', $params);
    }

    /**
     * Get a single customer by ID.
     *
     * @param  int  $id  The customer ID.
     * @return array<string, mixed>
     */
    public function getCustomer(int $id): array
    {
        return $this->request('GET', '/customers/' . $id);
    }

    /**
     * Create a new customer.
     *
     * @param  array<string, mixed>  $data  Customer payload (firstName, lastName, emails, etc.).
     * @return array<string, mixed>
     */
    public function createCustomer(array $data): array
    {
        return $this->request('POST', '/customers', $data);
    }

    /**
     * List mailboxes.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., page).
     * @return array<string, mixed>
     */
    public function listMailboxes(array $params = []): array
    {
        return $this->request('GET', '/mailboxes', $params);
    }

    /**
     * Get a single mailbox by ID.
     *
     * @param  int  $id  The mailbox ID.
     * @return array<string, mixed>
     */
    public function getMailbox(int $id): array
    {
        return $this->request('GET', '/mailboxes/' . $id);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
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
     * Make a raw HTTP request to the HelpScout API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('HelpScout access token is not configured.');
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
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("HelpScout API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("HelpScout API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("HelpScout API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("HelpScout API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("HelpScout API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to HelpScout API: {$e->getMessage()}");
        }
    }
}
