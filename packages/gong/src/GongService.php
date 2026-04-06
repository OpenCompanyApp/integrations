<?php

namespace OpenCompany\Integrations\Gong;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Gong API service for interacting with the Gong revenue intelligence platform.
 *
 * Handles HTTP communication with the Gong REST API using HTTP Basic
 * authentication (accessKey:accessKeySecret). Provides methods for listing
 * and retrieving calls, users, deals, and interactions.
 */
class GongService
{
    /**
     * Create a new GongService instance.
     *
     * @param  string  $accessKey  The Gong API access key.
     * @param  string  $accessKeySecret  The Gong API access key secret.
     * @param  string  $baseUrl  The Gong API base URL.
     */
    public function __construct(
        private string $accessKey = '',
        private string $accessKeySecret = '',
        private string $baseUrl = 'https://api.gong.io',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Gong integration is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessKey) && !empty($this->accessKeySecret);
    }

    /**
     * List calls from Gong.
     *
     * @param  array  $filters  Optional filters (fromDateTime, toDateTime, workspaceId, etc.).
     * @return array The API response containing call objects.
     */
    public function listCalls(array $filters = []): array
    {
        return $this->request('POST', '/v2/calls', $filters);
    }

    /**
     * Get a single call by its ID.
     *
     * @param  string  $callId  The unique call identifier.
     * @return array The call object.
     */
    public function getCall(string $callId): array
    {
        return $this->request('GET', '/v2/calls/' . urlencode($callId));
    }

    /**
     * List users from Gong.
     *
     * @param  array  $filters  Optional filters.
     * @return array The API response containing user objects.
     */
    public function listUsers(array $filters = []): array
    {
        return $this->request('POST', '/v2/users', $filters);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array The current user object.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/users/me');
    }

    /**
     * List deals from Gong.
     *
     * @param  array  $filters  Optional filters (fromDateTime, toDateTime, etc.).
     * @return array The API response containing deal objects.
     */
    public function listDeals(array $filters = []): array
    {
        return $this->request('POST', '/v2/deals', $filters);
    }

    /**
     * List interactions from Gong.
     *
     * @param  array  $filters  Optional filters.
     * @return array The API response containing interaction objects.
     */
    public function listInteractions(array $filters = []): array
    {
        return $this->request('POST', '/v2/interactions', $filters);
    }

    /**
     * List transcripts from Gong.
     *
     * @param  array  $filters  Optional query parameters (page, limit, downloadDate, callType, status).
     * @return array The API response containing transcript objects.
     */
    public function listTranscripts(array $filters = []): array
    {
        return $this->request('GET', '/v1/transcripts', $filters);
    }

    /**
     * Get a single transcript by its ID.
     *
     * @param  string  $transcriptId  The unique transcript identifier.
     * @return array The transcript object.
     */
    public function getTranscript(string $transcriptId): array
    {
        return $this->request('GET', '/v1/transcripts/' . urlencode($transcriptId));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path.
     * @param  array  $data  Request body or query parameters.
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Gong API using HTTP Basic authentication.
     *
     * @param  string  $method  The HTTP method.
     * @param  string  $path  The API endpoint path.
     * @param  array  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If credentials are missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessKey || !$this->accessKeySecret) {
            throw new \RuntimeException('Gong API credentials (access_key and access_key_secret) are not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($this->accessKey, $this->accessKeySecret)
              ->timeout(30);

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
                    Log::warning("Gong API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Gong API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('errors') ?? $body;
                Log::error("Gong API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Gong API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Gong API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Gong API: {$e->getMessage()}");
        }
    }
}
