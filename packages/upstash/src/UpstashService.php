<?php

namespace OpenCompany\Integrations\Upstash;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service client for the Upstash Redis REST API and Platform API.
 *
 * Upstash exposes two distinct APIs:
 *   - **Redis REST API** — data-plane operations (get, set, del, keys, info)
 *     on a specific Redis database. Base URL is the per-database endpoint
 *     (e.g. https://xxx-12345.upstash.io).
 *   - **Platform API** — management-plane operations (list databases, get
 *     database, teams) at https://api.upstash.com.
 *
 * Both APIs are authenticated with the same Upstash API key via Bearer auth.
 */
class UpstashService
{
    /**
     * Base URL for the Redis REST API (per-database endpoint).
     */
    private string $redisUrl;

    /**
     * Base URL for the Upstash Platform API.
     */
    private string $platformUrl = 'https://api.upstash.com';

    /**
     * Create a new UpstashService instance.
     *
     * @param  string  $apiKey   Upstash API key (used for both APIs).
     * @param  string  $redisUrl Redis REST API base URL (e.g. https://xxx-12345.upstash.io).
     */
    public function __construct(
        private string $apiKey = '',
        string $redisUrl = '',
    ) {
        $this->redisUrl = rtrim($redisUrl, '/');
    }

    /**
     * Check whether the service has enough configuration to make requests.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    // -------------------------------------------------------------------------
    // Redis REST API — data-plane operations
    // -------------------------------------------------------------------------

    /**
     * Retrieve the value stored at the given key.
     *
     * Uses GET /get/{key} on the Redis REST API.
     *
     * @param  string  $key  The Redis key to retrieve.
     * @return mixed The stored value (string, int, null if key does not exist).
     */
    public function get(string $key): mixed
    {
        return $this->redisRequest('GET', '/get/' . urlencode($key));
    }

    /**
     * Store a value at the given key, optionally with a TTL.
     *
     * Uses the pipeline endpoint POST /pipeline with a ["SET", key, value] command,
     * optionally followed by ["EXPIRE", key, ttl].
     *
     * @param  string  $key    The Redis key to set.
     * @param  string  $value  The value to store.
     * @param  int|null  $ttl  Time-to-live in seconds (optional).
     * @return mixed The API response.
     */
    public function set(string $key, string $value, ?int $ttl = null): mixed
    {
        $pipeline = [['SET', $key, $value]];

        if ($ttl !== null && $ttl > 0) {
            $pipeline[] = ['EXPIRE', $key, $ttl];
        }

        return $this->redisRequest('POST', '/pipeline', $pipeline);
    }

    /**
     * Delete the given key from Redis.
     *
     * Uses GET /del/{key} on the Redis REST API.
     *
     * @param  string  $key  The Redis key to delete.
     * @return mixed The API response (number of keys deleted).
     */
    public function delete(string $key): mixed
    {
        return $this->redisRequest('GET', '/del/' . urlencode($key));
    }

    /**
     * List Redis keys matching the given pattern.
     *
     * Uses GET /keys/{pattern} on the Redis REST API.
     *
     * @param  string  $pattern  Glob-style pattern (default "*" for all keys).
     * @return array<string> List of matching key names.
     */
    public function listKeys(string $pattern = '*'): array
    {
        $result = $this->redisRequest('GET', '/keys/' . urlencode($pattern));

        return is_array($result) ? $result : [];
    }

    /**
     * Get server info for the connected Redis database.
     *
     * Uses GET /info on the Redis REST API.
     *
     * @return array|string The info response.
     */
    public function info(): mixed
    {
        return $this->redisRequest('GET', '/info');
    }

    // -------------------------------------------------------------------------
    // Platform API — management-plane operations
    // -------------------------------------------------------------------------

    /**
     * List all Redis databases in the Upstash account.
     *
     * Uses GET /v2/redis/databases on the Platform API.
     *
     * @return array List of database objects.
     */
    public function listDatabases(): array
    {
        $result = $this->platformRequest('GET', '/v2/redis/databases');

        return is_array($result) ? $result : [];
    }

    /**
     * Get details for a specific Redis database.
     *
     * Uses GET /v2/redis/databases/{id} on the Platform API.
     *
     * @param  string  $id  The Upstash database ID.
     * @return array The database details.
     */
    public function getDatabase(string $id): array
    {
        $result = $this->platformRequest('GET', '/v2/redis/databases/' . urlencode($id));

        return is_array($result) ? $result : [];
    }

    /**
     * Get the current user's team information.
     *
     * Uses GET /v2/teams on the Platform API.
     *
     * @return array Team information.
     */
    public function getTeamInfo(): array
    {
        $result = $this->platformRequest('GET', '/v2/teams');

        return is_array($result) ? $result : [];
    }

    // -------------------------------------------------------------------------
    // Internal request helpers
    // -------------------------------------------------------------------------

    /**
     * Make a request to the Redis REST API and return the parsed response.
     *
     * @param  string  $method  HTTP method (GET, POST, etc.).
     * @param  string  $path   API path (e.g. /get/mykey).
     * @param  mixed   $data   Request body (for POST) or query params (for GET).
     * @return mixed Parsed JSON response.
     *
     * @throws \RuntimeException On connection or API errors.
     */
    private function redisRequest(string $method, string $path, mixed $data = null): mixed
    {
        $response = $this->doRequest($this->redisUrl, $method, $path, $data);

        return $response->json();
    }

    /**
     * Make a request to the Upstash Platform API and return the parsed response.
     *
     * @param  string  $method  HTTP method (GET, POST, etc.).
     * @param  string  $path   API path (e.g. /v2/redis/databases).
     * @param  mixed   $data   Request body (for POST) or query params (for GET).
     * @return mixed Parsed JSON response.
     *
     * @throws \RuntimeException On connection or API errors.
     */
    private function platformRequest(string $method, string $path, mixed $data = null): mixed
    {
        $response = $this->doRequest($this->platformUrl, $method, $path, $data);

        return $response->json();
    }

    /**
     * Execute an authenticated HTTP request to a given base URL.
     *
     * @param  string  $baseUrl  The base URL (Redis REST or Platform).
     * @param  string  $method   HTTP method.
     * @param  string  $path     API path.
     * @param  mixed   $data     Body or query params.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException On missing config, connection failure, or API error.
     */
    private function doRequest(string $baseUrl, string $method, string $path, mixed $data = null): \Illuminate\Http\Client\Response
    {
        if (empty($this->apiKey)) {
            throw new \RuntimeException('Upstash API key is not configured.');
        }

        $url = $baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, is_array($data) ? $data : []),
                'POST' => $http->post($url, $data ?? []),
                'PUT' => $http->put($url, $data ?? []),
                'DELETE' => $http->delete($url, is_array($data) ? $data : []),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->body();
                Log::error("Upstash API error: {$method} {$path}", [
                    'base' => $baseUrl,
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException(
                    "Upstash API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Upstash API connection error: {$method} {$path}", [
                'base' => $baseUrl,
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Upstash API: {$e->getMessage()}");
        }
    }
}
