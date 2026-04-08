<?php

namespace OpenCompany\Integrations\Braze;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Braze REST API service client.
 *
 * Handles authentication, request execution, and error handling for all
 * Braze REST API endpoints used by the integration tools.
 *
 * @see https://www.braze.com/docs/api/basics/
 */
class BrazeService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://rest.iad-01.braze.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List campaigns with pagination.
     *
     * @param  int  $page  Page number (0-indexed, default 0).
     * @param  int  $limit  Number of results per page (max 100, default 100).
     * @return array<string, mixed>
     *
     * @see https://www.braze.com/docs/api/endpoints/export/campaigns/get_campaigns/
     */
    public function listCampaigns(int $page = 0, int $limit = 100): array
    {
        return $this->request('GET', '/campaigns/list', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get details for a specific campaign.
     *
     * @param  string  $campaignId  The Braze campaign identifier.
     * @return array<string, mixed>
     *
     * @see https://www.braze.com/docs/api/endpoints/export/campaigns/get_campaign_details/
     */
    public function getCampaign(string $campaignId): array
    {
        return $this->request('GET', '/campaigns/details', [
            'campaign_id' => $campaignId,
        ]);
    }

    /**
     * List canvases with pagination.
     *
     * @param  int  $page  Page number (0-indexed, default 0).
     * @param  int  $limit  Number of results per page (max 100, default 100).
     * @return array<string, mixed>
     *
     * @see https://www.braze.com/docs/api/endpoints/export/canvas/get_canvas/
     */
    public function listCanvases(int $page = 0, int $limit = 100): array
    {
        return $this->request('GET', '/canvas/list', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get details for a specific canvas.
     *
     * @param  string  $canvasId  The Braze canvas identifier.
     * @return array<string, mixed>
     *
     * @see https://www.braze.com/docs/api/endpoints/export/canvas/get_canvas_details/
     */
    public function getCanvas(string $canvasId): array
    {
        return $this->request('GET', '/canvas/details', [
            'canvas_id' => $canvasId,
        ]);
    }

    /**
     * Export users by segment or external IDs.
     *
     * @param  array<string>|null  $externalIds  Array of external IDs to look up.
     * @param  string|null  $segmentId  Segment ID to export users from.
     * @param  int  $limit  Maximum number of users to return (max 5000, default 50).
     * @return array<string, mixed>
     *
     * @see https://www.braze.com/docs/api/endpoints/export/user_data/post_users_export/
     */
    public function exportUsers(?array $externalIds = null, ?string $segmentId = null, int $limit = 50): array
    {
        $body = [];

        if ($externalIds !== null) {
            $body['external_ids'] = $externalIds;
        }

        if ($segmentId !== null) {
            $body['segment_id'] = $segmentId;
        }

        $body['limit'] = $limit;

        return $this->request('POST', '/users/export', $body);
    }

    /**
     * Get the current authenticated user's profile.
     *
     * @return array<string, mixed>
     *
     * @see https://www.braze.com/docs/api/endpoints/user_data/post_users_identify/
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., "/campaigns/list").
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Braze REST API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request payload.
     *
     * @throws \RuntimeException On authentication or connection errors.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Braze API key is not configured.');
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
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Braze API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Braze API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the base URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Braze API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Braze API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Braze API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Braze API: {$e->getMessage()}");
        }
    }
}
