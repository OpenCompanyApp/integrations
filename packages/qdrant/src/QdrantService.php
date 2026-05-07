<?php

namespace OpenCompany\Integrations\Qdrant;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Qdrant REST API.
 *
 * Handles authentication, collection management, point operations, payload indexes, aliases, and snapshots.
 */
class QdrantService
{
    /**
     * @param  string  $apiKey  Qdrant Cloud API key or self-hosted API key.
     * @param  string  $baseUrl  Qdrant REST API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://your-cluster-url.qdrant.tech:6333',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an API key configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List all collections in the Qdrant cluster.
     *
     * @return array<string, mixed>
     */
    public function listCollections(): array
    {
        return $this->request('GET', '/collections');
    }

    /**
     * Get detailed information about a specific collection.
     *
     * @return array<string, mixed>
     */
    public function getCollection(string $name): array
    {
        return $this->request('GET', '/collections/'.rawurlencode($name));
    }

    /**
     * Create a new collection with the given vector configuration.
     *
     * @param  array<string, mixed>  $config  Collection creation payload (vectors, hnsw_config, etc.).
     * @return array<string, mixed>
     */
    public function createCollection(string $name, array $config = []): array
    {
        return $this->request('PUT', '/collections/'.rawurlencode($name), $config);
    }

    /**
     * Delete a collection.
     *
     * @return array<string, mixed>
     */
    public function deleteCollection(string $name, array $params = []): array
    {
        return $this->request('DELETE', '/collections/'.rawurlencode($name), $params);
    }

    /**
     * Create a payload index for a collection field.
     *
     * @param  array<string, mixed>  $body  Payload index creation body.
     * @return array<string, mixed>
     */
    public function createPayloadIndex(string $collection, array $body): array
    {
        return $this->request('PUT', '/collections/'.rawurlencode($collection).'/index', $body);
    }

    /**
     * Delete a payload index for a collection field.
     *
     * @return array<string, mixed>
     */
    public function deletePayloadIndex(string $collection, string $fieldName): array
    {
        return $this->request('DELETE', '/collections/'.rawurlencode($collection).'/index/'.rawurlencode($fieldName));
    }

    /**
     * Search for points in a collection using a vector or filter.
     *
     * @param  array<string, mixed>  $body  Search payload (vector, filter, limit, with_payload, etc.).
     * @return array<string, mixed>
     */
    public function search(string $collection, array $body): array
    {
        return $this->request('POST', '/collections/'.rawurlencode($collection).'/points/search', $body);
    }

    /**
     * Query points with the modern Qdrant Query API.
     *
     * @param  array<string, mixed>  $body  Query API payload.
     * @return array<string, mixed>
     */
    public function queryPoints(string $collection, array $body): array
    {
        return $this->request('POST', '/collections/'.rawurlencode($collection).'/points/query', $body);
    }

    /**
     * Retrieve points by IDs.
     *
     * @param  array<string, mixed>  $body  Retrieve payload with ids and selection options.
     * @return array<string, mixed>
     */
    public function retrievePoints(string $collection, array $body): array
    {
        return $this->request('POST', '/collections/'.rawurlencode($collection).'/points', $body);
    }

    /**
     * Scroll points page by page.
     *
     * @param  array<string, mixed>  $body  Scroll payload with filter, limit, offset, and selection options.
     * @return array<string, mixed>
     */
    public function scrollPoints(string $collection, array $body): array
    {
        return $this->request('POST', '/collections/'.rawurlencode($collection).'/points/scroll', $body);
    }

    /**
     * Count points matching an optional filter.
     *
     * @param  array<string, mixed>  $body  Count payload.
     * @return array<string, mixed>
     */
    public function countPoints(string $collection, array $body = []): array
    {
        return $this->request('POST', '/collections/'.rawurlencode($collection).'/points/count', $body);
    }

    /**
     * Upsert (insert or update) points into a collection.
     *
     * @param  array<string, mixed>  $body  Upsert payload containing a "points" array.
     * @return array<string, mixed>
     */
    public function upsertPoints(string $collection, array $body, array $params = []): array
    {
        return $this->request('PUT', $this->withQuery('/collections/'.rawurlencode($collection).'/points', $params), $body);
    }

    /**
     * Delete points by IDs or filter.
     *
     * @param  array<string, mixed>  $body  Points selector payload.
     * @param  array<string, mixed>  $params  Query parameters such as wait or ordering.
     * @return array<string, mixed>
     */
    public function deletePoints(string $collection, array $body, array $params = []): array
    {
        return $this->request('POST', $this->withQuery('/collections/'.rawurlencode($collection).'/points/delete', $params), $body);
    }

    /**
     * Set payload values on points by IDs or filter.
     *
     * @param  array<string, mixed>  $body  Set payload operation body.
     * @param  array<string, mixed>  $params  Query parameters such as wait or ordering.
     * @return array<string, mixed>
     */
    public function setPayload(string $collection, array $body, array $params = []): array
    {
        return $this->request('POST', $this->withQuery('/collections/'.rawurlencode($collection).'/points/payload', $params), $body);
    }

    /**
     * Delete payload keys from points by IDs or filter.
     *
     * @param  array<string, mixed>  $body  Delete payload operation body.
     * @param  array<string, mixed>  $params  Query parameters such as wait or ordering.
     * @return array<string, mixed>
     */
    public function deletePayload(string $collection, array $body, array $params = []): array
    {
        return $this->request('POST', $this->withQuery('/collections/'.rawurlencode($collection).'/points/payload/delete', $params), $body);
    }

    /**
     * Clear all payload from points by IDs or filter.
     *
     * @param  array<string, mixed>  $body  Clear payload operation body.
     * @param  array<string, mixed>  $params  Query parameters such as wait or ordering.
     * @return array<string, mixed>
     */
    public function clearPayload(string $collection, array $body, array $params = []): array
    {
        return $this->request('POST', $this->withQuery('/collections/'.rawurlencode($collection).'/points/payload/clear', $params), $body);
    }

    /**
     * Get information about the Qdrant cluster.
     *
     * @return array<string, mixed>
     */
    public function getClusterInfo(): array
    {
        return $this->request('GET', '/cluster');
    }

    /**
     * List all collection aliases.
     *
     * @return array<string, mixed>
     */
    public function listAliases(): array
    {
        return $this->request('GET', '/aliases');
    }

    /**
     * List aliases for a collection.
     *
     * @return array<string, mixed>
     */
    public function listCollectionAliases(string $collection): array
    {
        return $this->request('GET', '/collections/'.rawurlencode($collection).'/aliases');
    }

    /**
     * Update collection aliases atomically.
     *
     * @param  array<string, mixed>  $body  Alias operation payload.
     * @return array<string, mixed>
     */
    public function updateAliases(array $body): array
    {
        return $this->request('POST', '/collections/aliases', $body);
    }

    /**
     * List collection snapshots.
     *
     * @return array<string, mixed>
     */
    public function listSnapshots(string $collection): array
    {
        return $this->request('GET', '/collections/'.rawurlencode($collection).'/snapshots');
    }

    /**
     * Create a collection snapshot.
     *
     * @return array<string, mixed>
     */
    public function createSnapshot(string $collection): array
    {
        return $this->request('POST', '/collections/'.rawurlencode($collection).'/snapshots');
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
     * Make a raw HTTP request to the Qdrant REST API.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->apiKey) {
            throw new RuntimeException('Qdrant API key is not configured.');
        }

        $url = $this->baseUrl.$path;

        try {
            $http = Http::withHeaders([
                'api-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Qdrant API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("Qdrant API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('status') ?? $response->json('error') ?? $body;
                Log::error("Qdrant API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Qdrant API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Qdrant API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Qdrant API: {$e->getMessage()}");
        }
    }

    /**
     * Append query parameters to a relative path.
     *
     * @param  array<string, mixed>  $params
     */
    private function withQuery(string $path, array $params = []): string
    {
        $params = array_filter($params, static fn (mixed $value): bool => $value !== null);

        if ($params === []) {
            return $path;
        }

        return $path.'?'.http_build_query($params);
    }
}
