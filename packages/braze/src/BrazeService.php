<?php

namespace OpenCompany\Integrations\Braze;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Braze REST API.
 *
 * Handles bearer-token authentication, region-specific REST endpoints,
 * request dispatch, error logging, and JSON response parsing.
 */
class BrazeService
{
    /**
     * @param  string  $apiKey  Braze REST API key.
     * @param  string  $baseUrl  Braze REST endpoint for the account region.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://rest.iad-01.braze.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * List campaigns with pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCampaigns(array $params = []): array
    {
        return $this->apiGet('/campaigns/list', $params);
    }

    /**
     * Get details for a campaign.
     *
     * @return array<string, mixed>
     */
    public function getCampaign(string $campaignId): array
    {
        return $this->apiGet('/campaigns/details', ['campaign_id' => $campaignId]);
    }

    /**
     * List Canvases with pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCanvases(array $params = []): array
    {
        return $this->apiGet('/canvas/list', $params);
    }

    /**
     * Get details for a Canvas.
     *
     * @return array<string, mixed>
     */
    public function getCanvas(string $canvasId): array
    {
        return $this->apiGet('/canvas/details', ['canvas_id' => $canvasId]);
    }

    /**
     * Export users by identifier or segment.
     *
     * @param  array<string, mixed>  $data  User export payload.
     * @return array<string, mixed>
     */
    public function exportUsers(array $data): array
    {
        return $this->apiPost('/users/export/ids', $data);
    }

    /**
     * Send a GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Send a POST request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $data = [], array $query = []): array
    {
        return $this->request('POST', $path, $data, $query);
    }

    /**
     * Send a PUT request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $data = [], array $query = []): array
    {
        return $this->request('PUT', $path, $data, $query);
    }

    /**
     * Send a PATCH request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $data = [], array $query = []): array
    {
        return $this->request('PATCH', $path, $data, $query);
    }

    /**
     * Send a DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $data  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = [], array $data = []): array
    {
        return $this->request('DELETE', $path, $data, $query);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query params for GET/DELETE or body for mutating requests.
     * @param  array<string, mixed>  $query  Query params for mutating requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $query);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to Braze.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): Response
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('Braze API key is not configured.');
        }

        $url = $this->baseUrl . '/' . ltrim($path, '/');

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])
                ->acceptJson()
                ->asJson()
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->withOptions(['query' => $query])->post($url, $data),
                'PUT' => $http->withOptions(['query' => $query])->put($url, $data),
                'PATCH' => $http->withOptions(['query' => $query])->patch($url, $data),
                'DELETE' => $data === []
                    ? $http->withOptions(['query' => $query])->delete($url)
                    : $http->withOptions(['query' => $query])->send('DELETE', $url, ['json' => $data]),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();

                Log::error("Braze API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('Braze API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Braze API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Braze API: {$e->getMessage()}");
        }
    }
}
