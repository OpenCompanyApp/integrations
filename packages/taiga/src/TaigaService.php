<?php

namespace OpenCompany\Integrations\Taiga;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TaigaService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.taiga.io/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all projects the authenticated user has access to.
     *
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. membership, slug, order_by).
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/projects', $params);
    }

    /**
     * Get detailed information about a single project.
     *
     * @param  int  $id  The Taiga project ID.
     * @return array<string, mixed>
     */
    public function getProject(int $id): array
    {
        return $this->request('GET', '/projects/' . $id);
    }

    /**
     * List user stories, optionally filtered by query parameters.
     *
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. project, status, milestone).
     * @return array<string, mixed>
     */
    public function listUserStories(array $params = []): array
    {
        return $this->request('GET', '/userstories', $params);
    }

    /**
     * Get detailed information about a single user story.
     *
     * @param  int  $id  The Taiga user story ID.
     * @return array<string, mixed>
     */
    public function getUserStory(int $id): array
    {
        return $this->request('GET', '/userstories/' . $id);
    }

    /**
     * Create a new user story.
     *
     * @param  array<string, mixed>  $data  User story payload (project, subject, description, etc.).
     * @return array<string, mixed>
     */
    public function createUserStory(array $data): array
    {
        return $this->request('POST', '/userstories', $data);
    }

    /**
     * List issues, optionally filtered by query parameters.
     *
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. project, status, priority).
     * @return array<string, mixed>
     */
    public function listIssues(array $params = []): array
    {
        return $this->request('GET', '/issues', $params);
    }

    /**
     * Get the currently authenticated user's profile.
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
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE, PATCH).
     * @param  string  $path    API path (e.g. "/projects").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Taiga API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Taiga access token is not configured.');
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
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Taiga API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Taiga API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('detail') ?? $body;
                Log::error("Taiga API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Taiga API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Taiga API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Taiga API: {$e->getMessage()}");
        }
    }
}
