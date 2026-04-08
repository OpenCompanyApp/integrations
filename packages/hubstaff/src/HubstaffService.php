<?php

namespace OpenCompany\Integrations\Hubstaff;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HubstaffService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.hubstaff.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List time entries.
     *
     * @param  array<string, mixed>  $params  Query parameters (startTime, endTime, userIds, projectId, limit, page).
     * @return array<string, mixed>
     */
    public function listTimeEntries(array $params = []): array
    {
        return $this->request('GET', '/v2/time-entries', $params);
    }

    /**
     * Get a single time entry by ID.
     *
     * @return array<string, mixed>
     */
    public function getTimeEntry(int $id): array
    {
        return $this->request('GET', '/v2/time-entries/' . $id);
    }

    /**
     * Create a new time entry.
     *
     * @param  array<string, mixed>  $data  Time entry data (project_id, date, duration, notes).
     * @return array<string, mixed>
     */
    public function createTimeEntry(array $data): array
    {
        return $this->request('POST', '/v2/time-entries', $data);
    }

    /**
     * List projects.
     *
     * @param  array<string, mixed>  $params  Query parameters (status, limit, page).
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/v2/projects', $params);
    }

    /**
     * Get a single project by ID.
     *
     * @return array<string, mixed>
     */
    public function getProject(int $id): array
    {
        return $this->request('GET', '/v2/projects/' . $id);
    }

    /**
     * List organizations.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, page).
     * @return array<string, mixed>
     */
    public function listOrganizations(array $params = []): array
    {
        return $this->request('GET', '/v2/organizations', $params);
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Hubstaff API.
     *
     * @param  array<string, mixed>  $data
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Hubstaff access token is not configured.');
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
                    Log::warning("Hubstaff API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Hubstaff API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Hubstaff API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Hubstaff API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Hubstaff API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Hubstaff API: {$e->getMessage()}");
        }
    }
}
