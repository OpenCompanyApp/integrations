<?php

namespace OpenCompany\Integrations\Transifex;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TransifexService
{
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.transifex.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    /**
     * List all projects the authenticated user has access to.
     *
     * @return array<string, mixed>
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/projects');
    }

    /**
     * Get details of a specific project.
     *
     * @param  string  $projectId  The project slug or ID.
     * @return array<string, mixed>
     */
    public function getProject(string $projectId): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectId));
    }

    /**
     * List resources (source files) in a project.
     *
     * @param  string  $projectId  The project slug or ID.
     * @return array<string, mixed>
     */
    public function listResources(string $projectId): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectId) . '/resources');
    }

    /**
     * Get details of a specific resource.
     *
     * @param  string  $projectId   The project slug or ID.
     * @param  string  $resourceId  The resource slug or ID.
     * @return array<string, mixed>
     */
    public function getResource(string $projectId, string $resourceId): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectId) . '/resources/' . urlencode($resourceId));
    }

    /**
     * List translations for a specific resource.
     *
     * @param  string  $projectId   The project slug or ID.
     * @param  string  $resourceId  The resource slug or ID.
     * @param  string|null  $langCode  Optional language code to filter translations.
     * @return array<string, mixed>
     */
    public function listTranslations(string $projectId, string $resourceId, ?string $langCode = null): array
    {
        $path = '/projects/' . urlencode($projectId) . '/resources/' . urlencode($resourceId) . '/translations';
        $params = [];
        if ($langCode !== null) {
            $params['lang'] = $langCode;
        }
        return $this->request('GET', $path, $params);
    }

    /**
     * List languages for a specific project.
     *
     * @param  string  $projectId  The project slug or ID.
     * @return array<string, mixed>
     */
    public function listLanguages(string $projectId): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectId) . '/languages');
    }

    /**
     * Get the currently authenticated user's information.
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
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST/PUT).
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Transifex API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new \RuntimeException('Transifex API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
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
                    Log::warning("Transifex API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Transifex API endpoint not available (HTTP {$response->status()}). Check the base URL configuration.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Transifex API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Transifex API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Transifex API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Transifex API: {$e->getMessage()}");
        }
    }
}
