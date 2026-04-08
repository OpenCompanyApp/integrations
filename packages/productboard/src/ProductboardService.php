<?php

namespace OpenCompany\Integrations\Productboard;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProductboardService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.productboard.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List features with optional pagination and filters.
     *
     * @param  int  $pageSize  Number of features per page (max 100).
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @param  array  $filters  Optional query filters (e.g., status, product_id).
     * @return array<string, mixed>
     */
    public function listFeatures(int $pageSize = 100, ?string $cursor = null, array $filters = []): array
    {
        $params = ['pageSize' => min($pageSize, 100)];
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }
        foreach ($filters as $key => $value) {
            $params[$key] = $value;
        }

        return $this->request('GET', '/features', $params);
    }

    /**
     * Get a single feature by its ID.
     *
     * @param  string  $id  The feature identifier.
     * @return array<string, mixed>
     */
    public function getFeature(string $id): array
    {
        return $this->request('GET', '/features/' . urlencode($id));
    }

    /**
     * Create a new feature.
     *
     * @param  array<string, mixed>  $data  Feature payload (name, description, product_id, etc.).
     * @return array<string, mixed>
     */
    public function createFeature(array $data): array
    {
        return $this->request('POST', '/features', $data);
    }

    /**
     * List notes with optional pagination.
     *
     * @param  int  $pageSize  Number of notes per page (max 100).
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listNotes(int $pageSize = 100, ?string $cursor = null): array
    {
        $params = ['pageSize' => min($pageSize, 100)];
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/notes', $params);
    }

    /**
     * Create a new note.
     *
     * @param  array<string, mixed>  $data  Note payload (title, content, owner, etc.).
     * @return array<string, mixed>
     */
    public function createNote(array $data): array
    {
        return $this->request('POST', '/notes', $data);
    }

    /**
     * List products with optional pagination.
     *
     * @param  int  $pageSize  Number of products per page (max 100).
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listProducts(int $pageSize = 100, ?string $cursor = null): array
    {
        $params = ['pageSize' => min($pageSize, 100)];
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/products', $params);
    }

    /**
     * List companies with optional pagination.
     *
     * @param  int  $pageSize  Number of companies per page (max 100).
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listCompanies(int $pageSize = 100, ?string $cursor = null): array
    {
        $params = ['pageSize' => min($pageSize, 100)];
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/companies', $params);
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
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Productboard API.
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
            throw new \RuntimeException('Productboard access token is not configured.');
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
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Productboard API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Productboard API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Productboard API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Productboard API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Productboard API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Productboard API: {$e->getMessage()}");
        }
    }
}
