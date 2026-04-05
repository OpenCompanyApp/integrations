<?php

namespace OpenCompany\Integrations\Webflow;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Webflow v2 REST API covering sites, collections, items, webhooks, assets, and users.
 *
 * Wraps the Webflow Data API (v2) and handles authentication via personal access token
 * or OAuth bearer token, request routing, and error reporting.
 */
class WebflowService
{
    private const BASE_URL = 'https://api.webflow.com/v2';
    private const API_VERSION = '2.0';

    /**
     * @param  string  $apiKey  Webflow personal access token or OAuth bearer token
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Sites ──────────────────────────────────────────────

    /**
     * List all sites the authenticated user has access to.
     *
     * @return array<string, mixed>
     */
    public function listSites(): array
    {
        return $this->request('GET', '/sites');
    }

    /**
     * Get details for a specific site.
     *
     * @param  string  $siteId  The site identifier
     * @return array<string, mixed>
     */
    public function getSite(string $siteId): array
    {
        return $this->request('GET', "/sites/{$siteId}");
    }

    /**
     * Publish a site.
     *
     * @param  string  $siteId  The site identifier
     * @return array<string, mixed>
     */
    public function publishSite(string $siteId): array
    {
        return $this->request('POST', "/sites/{$siteId}/publish");
    }

    // ── Collections ────────────────────────────────────────

    /**
     * List all collections for a site.
     *
     * @param  string  $siteId  The site identifier
     * @return array<string, mixed>
     */
    public function listCollections(string $siteId): array
    {
        return $this->request('GET', "/sites/{$siteId}/collections");
    }

    /**
     * Get a collection by its ID.
     *
     * @param  string  $collectionId  The collection identifier
     * @return array<string, mixed>
     */
    public function getCollection(string $collectionId): array
    {
        return $this->request('GET', "/collections/{$collectionId}");
    }

    // ── Items ──────────────────────────────────────────────

    /**
     * List items in a collection with optional pagination.
     *
     * @param  string  $collectionId  The collection identifier
     * @param  int  $limit  Maximum number of items to return
     * @param  int  $offset  Number of items to skip
     * @return array<string, mixed>
     */
    public function listItems(string $collectionId, int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', "/collections/{$collectionId}/items", [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single item from a collection.
     *
     * @param  string  $collectionId  The collection identifier
     * @param  string  $itemId  The item identifier
     * @return array<string, mixed>
     */
    public function getItem(string $collectionId, string $itemId): array
    {
        return $this->request('GET', "/collections/{$collectionId}/items/{$itemId}");
    }

    /**
     * Create a new item in a collection.
     *
     * @param  string  $collectionId  The collection identifier
     * @param  array<string, mixed>  $fields  The item field data
     * @param  bool  $isDraft  Whether the item is a draft
     * @param  bool  $isArchived  Whether the item is archived
     * @return array<string, mixed>
     */
    public function createItem(string $collectionId, array $fields, bool $isDraft = false, bool $isArchived = false): array
    {
        return $this->request('POST', "/collections/{$collectionId}/items", [
            'isDraft' => $isDraft,
            'isArchived' => $isArchived,
            'fieldData' => $fields,
        ]);
    }

    /**
     * Update an existing item in a collection.
     *
     * @param  string  $collectionId  The collection identifier
     * @param  string  $itemId  The item identifier
     * @param  array<string, mixed>  $fields  The item field data to update
     * @param  bool  $isDraft  Whether the item is a draft
     * @param  bool  $isArchived  Whether the item is archived
     * @return array<string, mixed>
     */
    public function updateItem(string $collectionId, string $itemId, array $fields, bool $isDraft = false, bool $isArchived = false): array
    {
        return $this->request('PUT', "/collections/{$collectionId}/items/{$itemId}", [
            'isDraft' => $isDraft,
            'isArchived' => $isArchived,
            'fieldData' => $fields,
        ]);
    }

    /**
     * Delete an item from a collection.
     *
     * @param  string  $collectionId  The collection identifier
     * @param  string  $itemId  The item identifier
     * @return array<string, mixed>
     */
    public function deleteItem(string $collectionId, string $itemId): array
    {
        return $this->request('DELETE', "/collections/{$collectionId}/items/{$itemId}");
    }

    // ── Webhooks ───────────────────────────────────────────

    /**
     * List all webhooks for a site.
     *
     * @param  string  $siteId  The site identifier
     * @return array<string, mixed>
     */
    public function listWebhooks(string $siteId): array
    {
        return $this->request('GET', "/sites/{$siteId}/webhooks");
    }

    /**
     * Create a webhook for a site.
     *
     * @param  string  $siteId  The site identifier
     * @param  string  $triggerType  The event trigger type (e.g. form_submission, site_publish)
     * @param  string  $url  The webhook callback URL
     * @return array<string, mixed>
     */
    public function createWebhook(string $siteId, string $triggerType, string $url): array
    {
        return $this->request('POST', "/sites/{$siteId}/webhooks", [
            'triggerType' => $triggerType,
            'url' => $url,
        ]);
    }

    /**
     * Delete a webhook from a site.
     *
     * @param  string  $siteId  The site identifier
     * @param  string  $webhookId  The webhook identifier
     * @return array<string, mixed>
     */
    public function deleteWebhook(string $siteId, string $webhookId): array
    {
        return $this->request('DELETE', "/sites/{$siteId}/webhooks/{$webhookId}");
    }

    // ── Assets ─────────────────────────────────────────────

    /**
     * List all assets for a site.
     *
     * @param  string  $siteId  The site identifier
     * @return array<string, mixed>
     */
    public function listAssets(string $siteId): array
    {
        return $this->request('GET', "/sites/{$siteId}/assets");
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to the Webflow v2 API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Request query parameters or JSON body
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Webflow API key is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'accept-version' => self::API_VERSION,
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get(self::BASE_URL . $path, $data),
                'POST' => $http->post(self::BASE_URL . $path, $data),
                'PUT' => $http->put(self::BASE_URL . $path, $data),
                'DELETE' => $http->delete(self::BASE_URL . $path, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['message'] ?? $body['msg'] ?? $body['error'] ?? $response->body();

                Log::error("Webflow API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $err,
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Webflow API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Webflow API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Webflow API: {$e->getMessage()}");
        }
    }
}
