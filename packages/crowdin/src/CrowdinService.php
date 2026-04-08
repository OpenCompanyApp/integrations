<?php

namespace OpenCompany\Integrations\Crowdin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CrowdinService
{
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.crowdin.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed> The API response containing user data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * List projects.
     *
     * @param  int|null  $groupId  Filter by group ID.
     * @param  int  $limit  Maximum number of items to return (max 500).
     * @param  int  $offset  Pagination offset.
     * @return array<string, mixed> The API response containing project list.
     */
    public function listProjects(?int $groupId = null, int $limit = 25, int $offset = 0): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($groupId !== null) {
            $params['groupId'] = $groupId;
        }

        return $this->request('GET', '/projects', $params);
    }

    /**
     * Get details of a specific project.
     *
     * @param  int  $projectId  The project ID.
     * @return array<string, mixed> The API response containing project details.
     */
    public function getProject(int $projectId): array
    {
        return $this->request('GET', '/projects/' . $projectId);
    }

    /**
     * List source strings in a project.
     *
     * @param  int  $projectId  The project ID.
     * @param  int|null  $fileId  Filter by file ID.
     * @param  int|null  $branchId  Filter by branch ID.
     * @param  int  $limit  Maximum number of items to return.
     * @param  int  $offset  Pagination offset.
     * @return array<string, mixed> The API response containing string list.
     */
    public function listStrings(int $projectId, ?int $fileId = null, ?int $branchId = null, int $limit = 25, int $offset = 0): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($fileId !== null) {
            $params['fileId'] = $fileId;
        }

        if ($branchId !== null) {
            $params['branchId'] = $branchId;
        }

        return $this->request('GET', '/projects/' . $projectId . '/strings', $params);
    }

    /**
     * Get details of a specific source string.
     *
     * @param  int  $projectId  The project ID.
     * @param  int  $stringId  The string ID.
     * @return array<string, mixed> The API response containing string details.
     */
    public function getString(int $projectId, int $stringId): array
    {
        return $this->request('GET', '/projects/' . $projectId . '/strings/' . $stringId);
    }

    /**
     * List translations for a specific string in a project.
     *
     * @param  int  $projectId  The project ID.
     * @param  int  $stringId  The string ID.
     * @param  int|null  $languageId  Filter by language ID.
     * @param  int  $limit  Maximum number of items to return.
     * @param  int  $offset  Pagination offset.
     * @return array<string, mixed> The API response containing translations.
     */
    public function listTranslations(int $projectId, int $stringId, ?int $languageId = null, int $limit = 25, int $offset = 0): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($languageId !== null) {
            $params['languageId'] = $languageId;
        }

        return $this->request('GET', '/projects/' . $projectId . '/translations', $params);
    }

    /**
     * List supported languages.
     *
     * @param  int  $limit  Maximum number of items to return.
     * @param  int  $offset  Pagination offset.
     * @return array<string, mixed> The API response containing language list.
     */
    public function listLanguages(int $limit = 25, int $offset = 0): array
    {
        return $this->request('GET', '/languages', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST/PUT).
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Crowdin API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new \RuntimeException('Crowdin API token is not configured.');
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
                    Log::warning("Crowdin API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Crowdin API endpoint not available (HTTP {$response->status()}). Check the base URL configuration.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Crowdin API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Crowdin API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Crowdin API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Crowdin API: {$e->getMessage()}");
        }
    }
}
