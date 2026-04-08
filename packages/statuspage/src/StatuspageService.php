<?php

namespace OpenCompany\Integrations\Statuspage;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StatuspageService
{
    public function __construct(
        private string $apiKey = '',
        private string $pageId = '',
        private string $baseUrl = 'https://api.statuspage.io/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has the minimum required configuration.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->pageId);
    }

    /**
     * Get the configured page ID.
     */
    public function getPageId(): string
    {
        return $this->pageId;
    }

    /**
     * Get the current authenticated user.
     *
     * @see https://developer.statuspage.io/#operation/getUsersMe
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * List all incidents for the configured page.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. filter, limit).
     * @return array<int, array<string, mixed>>
     *
     * @see https://developer.statuspage.io/#operation/getPagesPageIdIncidents
     */
    public function listIncidents(array $params = []): array
    {
        return $this->request('GET', "/pages/{$this->pageId}/incidents", $params);
    }

    /**
     * Create a new incident for the configured page.
     *
     * @param  array<string, mixed>  $incident  Incident payload (name, status, impact, body, etc.).
     * @return array<string, mixed>
     *
     * @see https://developer.statuspage.io/#operation/postPagesPageIdIncidents
     */
    public function createIncident(array $incident): array
    {
        return $this->request('POST', "/pages/{$this->pageId}/incidents", [
            'incident' => $incident,
        ]);
    }

    /**
     * Update an existing incident.
     *
     * @param  string  $incidentId  The incident ID to update.
     * @param  array<string, mixed>  $updates  Fields to update.
     * @return array<string, mixed>
     *
     * @see https://developer.statuspage.io/#operation/patchPagesPageIdIncidentsIncidentId
     */
    public function updateIncident(string $incidentId, array $updates): array
    {
        return $this->request('PATCH', "/pages/{$this->pageId}/incidents/{$incidentId}", [
            'incident' => $updates,
        ]);
    }

    /**
     * List all components for the configured page.
     *
     * @return array<int, array<string, mixed>>
     *
     * @see https://developer.statuspage.io/#operation/getPagesPageIdComponents
     */
    public function listComponents(): array
    {
        return $this->request('GET', "/pages/{$this->pageId}/components");
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/pages/{page_id}/incidents").
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Statuspage API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException  On connection failure or non-2xx response.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Statuspage API key is not configured.');
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
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Statuspage API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Statuspage API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Statuspage API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Statuspage API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Statuspage API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Statuspage API: {$e->getMessage()}");
        }
    }
}
