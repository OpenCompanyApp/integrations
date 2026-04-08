<?php

namespace OpenCompany\Integrations\PayloadCms;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Payload CMS REST API covering collections, documents, and user management.
 *
 * Wraps the Payload CMS API and handles authentication, request routing,
 * and error reporting.
 */
class PayloadCmsService
{
    private string $baseUrl;

    /**
     * @param  string  $apiToken  Payload CMS API token (Bearer auth)
     * @param  string  $baseUrl   Payload CMS API base URL
     */
    public function __construct(
        private string $apiToken = '',
        string $baseUrl = 'https://api.payloadcms.com/api',
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * Check whether the service has sufficient credentials to make API calls.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ── Collections ────────────────────────────────────────

    /**
     * List all collections.
     *
     * @return array<string, mixed>
     */
    public function listCollections(): array
    {
        return $this->request('GET', '/collections');
    }

    /**
     * Get a single collection by slug.
     *
     * @return array<string, mixed>
     */
    public function getCollection(string $slug): array
    {
        return $this->request('GET', "/collections/{$slug}");
    }

    // ── Documents ──────────────────────────────────────────

    /**
     * List documents in a collection.
     *
     * @param  string  $collection  Collection slug
     * @param  array<string, mixed>  $params  Query parameters (e.g. limit, page, sort, where)
     * @return array<string, mixed>
     */
    public function listDocuments(string $collection, array $params = []): array
    {
        return $this->request('GET', "/{$collection}", $params);
    }

    /**
     * Get a single document by ID.
     *
     * @param  string  $collection  Collection slug
     * @param  string  $documentId  Document ID
     * @return array<string, mixed>
     */
    public function getDocument(string $collection, string $documentId): array
    {
        return $this->request('GET', "/{$collection}/{$documentId}");
    }

    /**
     * Create a new document in a collection.
     *
     * @param  string  $collection  Collection slug
     * @param  array<string, mixed>  $body  Document field values
     * @return array<string, mixed>
     */
    public function createDocument(string $collection, array $body): array
    {
        return $this->request('POST', "/{$collection}", $body);
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * List users.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. limit, page)
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
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

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to the Payload CMS REST API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path relative to the base URL
     * @param  array<string, mixed>  $data  Query params (GET) or body data (POST/PUT)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Payload CMS API token is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($this->baseUrl . $path, $data),
                'POST' => $http->post($this->baseUrl . $path, $data),
                'PUT' => $http->put($this->baseUrl . $path, $data),
                'DELETE' => $http->delete($this->baseUrl . $path, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['message'] ?? $body['error'] ?? $response->body();

                Log::error("Payload CMS API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $err,
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Payload CMS API error (' . $response->status() . '): ' . $msg);
            }

            // DELETE may return 204 No Content
            if ($response->status() === 204) {
                return ['deleted' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Payload CMS API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Payload CMS API: {$e->getMessage()}");
        }
    }
}
