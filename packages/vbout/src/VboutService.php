<?php

namespace OpenCompany\Integrations\Vbout;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VboutService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.vbout.com/1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List contacts.
     *
     * @param  int  $limit  Maximum number of contacts to return.
     * @param  int  $offset  Offset for pagination.
     * @return array<string, mixed>
     */
    public function listContacts(int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', '/contacts/list', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  string  $id  The contact identifier.
     * @return array<string, mixed>
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', '/contact/' . urlencode($id));
    }

    /**
     * Create (add) a contact to a list.
     *
     * @param  string  $email  The contact's email address.
     * @param  string  $listId  The list to add the contact to.
     * @param  array<string, mixed>  $extra  Additional contact fields.
     * @return array<string, mixed>
     */
    public function createContact(string $email, string $listId, array $extra = []): array
    {
        return $this->request('POST', '/contact/add', array_merge([
            'email' => $email,
            'list_id' => $listId,
        ], $extra));
    }

    /**
     * List email campaigns.
     *
     * @param  int  $limit  Maximum number of campaigns to return.
     * @param  int  $offset  Offset for pagination.
     * @return array<string, mixed>
     */
    public function listCampaigns(int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', '/campaigns/list', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single campaign by ID.
     *
     * @param  string  $id  The campaign identifier.
     * @return array<string, mixed>
     */
    public function getCampaign(string $id): array
    {
        return $this->request('GET', '/campaign/' . urlencode($id));
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
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request parameters or body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the VBout API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request parameters or body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('VBout API key is not configured.');
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

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("VBout API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("VBout API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is down.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("VBout API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("VBout API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("VBout API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to VBout API: {$e->getMessage()}");
        }
    }
}
