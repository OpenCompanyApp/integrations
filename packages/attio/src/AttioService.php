<?php

namespace OpenCompany\Integrations\Attio;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AttioService
{
    /**
     * Create a new Attio service instance.
     *
     * @param  string  $apiKey  The Attio API key used for Bearer authentication.
     * @param  string  $baseUrl  The base URL for the Attio API (default: https://api.attio.com/v2).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.attio.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List records for a given object type.
     *
     * @param  string  $object  The object slug (e.g. "people", "companies").
     * @param  int  $limit  Maximum number of records to return.
     * @param  int  $offset  Number of records to skip for pagination.
     * @return array<string, mixed> The paginated list of records.
     */
    public function listRecords(string $object, int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', "/objects/{$object}/records", [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single record by ID.
     *
     * @param  string  $object  The object slug (e.g. "people", "companies").
     * @param  string  $id  The record UUID.
     * @return array<string, mixed> The record data.
     */
    public function getRecord(string $object, string $id): array
    {
        return $this->request('GET', "/objects/{$object}/records/{$id}");
    }

    /**
     * Create a new record for a given object type.
     *
     * @param  string  $object  The object slug (e.g. "people", "companies").
     * @param  array<string, mixed>  $data  The record data keyed by attribute slug.
     * @return array<string, mixed> The created record.
     */
    public function createRecord(string $object, array $data): array
    {
        return $this->request('POST', "/objects/{$object}/records", [
            'data' => $data,
        ]);
    }

    /**
     * Update an existing record by ID.
     *
     * @param  string  $object  The object slug (e.g. "people", "companies").
     * @param  string  $id  The record UUID.
     * @param  array<string, mixed>  $data  The record data to update, keyed by attribute slug.
     * @return array<string, mixed> The updated record.
     */
    public function updateRecord(string $object, string $id, array $data): array
    {
        return $this->request('PATCH', "/objects/{$object}/records/{$id}", [
            'data' => $data,
        ]);
    }

    /**
     * Delete a record by ID.
     *
     * @param  string  $object  The object slug (e.g. "people", "companies").
     * @param  string  $id  The record UUID.
     */
    public function deleteRecord(string $object, string $id): void
    {
        $this->request('DELETE', "/objects/{$object}/records/{$id}");
    }

    /**
     * List all objects defined in the workspace.
     *
     * @return array<string, mixed> The list of objects.
     */
    public function listObjects(): array
    {
        return $this->request('GET', '/objects');
    }

    /**
     * Get a single object by slug or ID.
     *
     * @param  string  $object  The object slug or UUID.
     * @return array<string, mixed> The object definition.
     */
    public function getObject(string $object): array
    {
        return $this->request('GET', "/objects/{$object}");
    }

    /**
     * List all lists in the workspace.
     *
     * @return array<string, mixed> The list of lists.
     */
    public function listLists(): array
    {
        return $this->request('GET', '/lists');
    }

    /**
     * Get a single list by ID.
     *
     * @param  string  $id  The list UUID.
     * @return array<string, mixed> The list data.
     */
    public function getList(string $id): array
    {
        return $this->request('GET', "/lists/{$id}");
    }

    /**
     * List entries for a given list.
     *
     * @param  string  $id  The list UUID.
     * @param  int  $limit  Maximum number of entries to return.
     * @param  int  $offset  Number of entries to skip for pagination.
     * @return array<string, mixed> The paginated list of entries.
     */
    public function listEntries(string $id, int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', "/lists/{$id}/entries", [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Create a note attached to a parent record.
     *
     * @param  string  $parentObject  The parent object slug (e.g. "people", "companies").
     * @param  string  $parentRecordId  The parent record UUID.
     * @param  string  $content  The note content (plain text or markdown).
     * @return array<string, mixed> The created note.
     */
    public function createNote(string $parentObject, string $parentRecordId, string $content): array
    {
        return $this->request('POST', '/notes', [
            'parent_object' => $parentObject,
            'parent_record_id' => $parentRecordId,
            'content' => $content,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed> The current user data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/self');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters (GET) or JSON body (POST/PATCH/DELETE).
     * @return array<string, mixed> The parsed JSON response body.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Attio API.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE).
     * @param  string  $path  API path relative to the base URL.
     * @param  array<string, mixed>  $data  Query parameters (GET) or JSON body (POST/PATCH/DELETE).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing, the connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Attio API key is not configured.');
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
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Attio API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Attio API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Attio API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Attio API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Attio API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Attio API: {$e->getMessage()}");
        }
    }
}
