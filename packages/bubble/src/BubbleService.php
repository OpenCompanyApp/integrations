<?php

namespace OpenCompany\Integrations\Bubble;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for interacting with the Bubble API.
 *
 * Provides methods to list, get, create, update, and delete records
 * from any Bubble data type via the Bubble Data API.
 *
 * @see https://manual.bubble.io/core-resources/api/data-api
 */
class BubbleService
{
    /**
     * @param  string  $apiKey  Bubble API token (generated in Settings → API).
     * @param  string  $baseUrl  Full base URL of the Bubble app (e.g. "https://myapp.bubbleapps.io").
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with valid credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->baseUrl);
    }

    /**
     * List records of a given type with optional constraints and pagination.
     *
     * @param  string  $type  The Bubble data type name (case-sensitive).
     * @param  array  $constraints  Array of Bubble constraint objects for filtering.
     * @param  int  $limit  Maximum number of records to return (1–100, default 100).
     * @param  int  $cursor  Offset for pagination (0-based).
     * @return array<string, mixed> The API response containing "response" (list of records) and "remaining" (int).
     */
    public function listRecords(string $type, array $constraints = [], int $limit = 100, int $cursor = 0): array
    {
        $body = [];
        if (!empty($constraints)) {
            $body['constraints'] = $constraints;
        }
        if ($limit !== 100) {
            $body['limit'] = $limit;
        }
        if ($cursor > 0) {
            $body['cursor'] = $cursor;
        }

        return $this->request('GET', '/obj/' . urlencode($type), $body);
    }

    /**
     * Get a single record by its Bubble ID.
     *
     * @param  string  $type  The Bubble data type name.
     * @param  string  $id  The unique identifier of the record.
     * @return array<string, mixed> The record data.
     */
    public function getRecord(string $type, string $id): array
    {
        return $this->request('GET', '/obj/' . urlencode($type) . '/' . urlencode($id));
    }

    /**
     * Create a new record of the given type.
     *
     * @param  string  $type  The Bubble data type name.
     * @param  array  $fields  Associative array of field names and values for the new record.
     * @return array<string, mixed> The created record data, including its "id".
     */
    public function createRecord(string $type, array $fields): array
    {
        return $this->request('POST', '/obj/' . urlencode($type), $fields);
    }

    /**
     * Update an existing record by its Bubble ID.
     *
     * Only the fields provided in $fields will be updated; other fields remain unchanged.
     *
     * @param  string  $type  The Bubble data type name.
     * @param  string  $id  The unique identifier of the record.
     * @param  array  $fields  Associative array of field names and values to update.
     * @return array<string, mixed> The updated record data.
     */
    public function updateRecord(string $type, string $id, array $fields): array
    {
        return $this->request('PATCH', '/obj/' . urlencode($type) . '/' . urlencode($id), $fields);
    }

    /**
     * Delete a record by its Bubble ID.
     *
     * @param  string  $type  The Bubble data type name.
     * @param  string  $id  The unique identifier of the record.
     */
    public function deleteRecord(string $type, string $id): void
    {
        $this->request('DELETE', '/obj/' . urlencode($type) . '/' . urlencode($id));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE).
     * @param  string  $path  API endpoint path (e.g. "/obj/User").
     * @param  array<string, mixed>  $data  Query parameters or JSON body depending on method.
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Bubble API.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Data to send (query params for GET, JSON body for POST/PATCH/DELETE).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key or base URL is missing, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Bubble API key is not configured.');
        }

        if (!$this->baseUrl) {
            throw new \RuntimeException('Bubble app URL is not configured.');
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Bubble API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Bubble API endpoint not available (HTTP {$response->status()}). Check your app URL and data type name.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Bubble API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Bubble API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Bubble API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Bubble API: {$e->getMessage()}");
        }
    }
}
