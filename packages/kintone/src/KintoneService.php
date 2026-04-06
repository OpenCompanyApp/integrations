<?php

namespace OpenCompany\Integrations\Kintone;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KintoneService
{
    public function __construct(
        private string $accessToken = '',
        private string $domain = '',
    ) {
        $this->domain = rtrim($this->domain, '/');
    }

    /**
     * Check whether the service is configured with an access token and domain.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->domain);
    }

    /**
     * Build the base URL from the configured domain.
     *
     * Supports both bare domains (e.g. "example.cybozu.com") and full URLs
     * (e.g. "https://example.cybozu.com").
     */
    public function getBaseUrl(): string
    {
        if (str_starts_with($this->domain, 'http://') || str_starts_with($this->domain, 'https://')) {
            return rtrim($this->domain, '/');
        }

        return 'https://' . $this->domain;
    }

    /**
     * List records from a Kintone app.
     *
     * @param  int  $app  The app ID.
     * @param  string|null  $query  Kintone query string (e.g. 'Status = "Open" order by Record_number asc').
     * @param  array|null  $fields  List of field codes to include.
     * @param  int|null  $limit  Maximum number of records to return (max 500, default 100).
     * @param  int|null  $offset  Number of records to skip.
     * @return array<string, mixed>
     */
    public function listRecords(int $app, ?string $query = null, ?array $fields = null, ?int $limit = null, ?int $offset = null): array
    {
        $params = ['app' => $app];

        if ($query !== null) {
            $params['query'] = $query;
        }
        if ($fields !== null) {
            $params['fields'] = $fields;
        }
        if ($limit !== null) {
            $params['query'] = ($params['query'] ?? '') . ' limit ' . $limit;
        }
        if ($offset !== null) {
            $params['query'] = ($params['query'] ?? '') . ' offset ' . $offset;
        }

        return $this->request('GET', '/k/v1/records.json', $params);
    }

    /**
     * Get a single record from a Kintone app.
     *
     * @param  int  $app  The app ID.
     * @param  int  $id  The record ID.
     * @return array<string, mixed>
     */
    public function getRecord(int $app, int $id): array
    {
        return $this->request('GET', '/k/v1/record.json', [
            'app' => $app,
            'id' => $id,
        ]);
    }

    /**
     * Create a record in a Kintone app.
     *
     * @param  int  $app  The app ID.
     * @param  array<string, array{value: mixed}>  $record  Field values keyed by field code.
     * @return array<string, mixed>
     */
    public function createRecord(int $app, array $record): array
    {
        return $this->request('POST', '/k/v1/record.json', [
            'app' => $app,
            'record' => $record,
        ]);
    }

    /**
     * List apps in the Kintone environment.
     *
     * @param  int|null  $limit  Maximum number of apps to return (default 100, max 500).
     * @param  int|null  $offset  Number of apps to skip.
     * @return array<string, mixed>
     */
    public function listApps(?int $limit = null, ?int $offset = null): array
    {
        $params = [];

        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/k/v1/apps.json', $params);
    }

    /**
     * Get details of a single Kintone app.
     *
     * @param  int  $id  The app ID.
     * @return array<string, mixed>
     */
    public function getApp(int $id): array
    {
        return $this->request('GET', '/k/v1/app.json', [
            'id' => $id,
        ]);
    }

    /**
     * List spaces in the Kintone environment.
     *
     * @param  int|null  $limit  Maximum number of spaces to return (default 100, max 500).
     * @param  int|null  $offset  Number of spaces to skip.
     * @return array<string, mixed>
     */
    public function listSpaces(?int $limit = null, ?int $offset = null): array
    {
        $params = [];

        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/k/v1/space.json', $params);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Kintone API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Kintone access token is not configured.');
        }

        if (!$this->domain) {
            throw new \RuntimeException('Kintone domain is not configured.');
        }

        $url = $this->getBaseUrl() . $path;

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
                $error = $response->json('message') ?? $response->body();

                Log::error("Kintone API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Kintone API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Kintone API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Kintone API: {$e->getMessage()}");
        }
    }
}
