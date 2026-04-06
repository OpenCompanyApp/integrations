<?php

namespace OpenCompany\Integrations\Sentry;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SentryService
{
    public function __construct(
        private string $authToken = '',
        private string $baseUrl = 'https://sentry.io/api/0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->authToken);
    }

    /**
     * List all projects accessible to the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/projects', $params);
    }

    /**
     * Get details for a specific project.
     *
     * @return array<string, mixed>
     */
    public function getProject(string $orgSlug, string $projectSlug): array
    {
        return $this->request('GET', '/projects/' . urlencode($orgSlug) . '/' . urlencode($projectSlug));
    }

    /**
     * List issues for a specific project.
     *
     * @return array<string, mixed>
     */
    public function listIssues(string $orgSlug, string $projectSlug, array $params = []): array
    {
        return $this->request('GET', '/projects/' . urlencode($orgSlug) . '/' . urlencode($projectSlug) . '/issues', $params);
    }

    /**
     * Get details for a specific issue.
     *
     * @return array<string, mixed>
     */
    public function getIssue(string $issueId): array
    {
        return $this->request('GET', '/issues/' . urlencode($issueId));
    }

    /**
     * List releases for a specific project.
     *
     * @return array<string, mixed>
     */
    public function listReleases(string $orgSlug, string $projectSlug, array $params = []): array
    {
        return $this->request('GET', '/projects/' . urlencode($orgSlug) . '/' . urlencode($projectSlug) . '/releases', $params);
    }

    /**
     * Create a new issue (user feedback / crash report) for a project.
     *
     * @return array<string, mixed>
     */
    public function createIssue(string $orgSlug, string $projectSlug, array $data): array
    {
        return $this->request('POST', '/projects/' . urlencode($orgSlug) . '/' . urlencode($projectSlug) . '/issues', $data);
    }

    /**
     * Get the currently authenticated user.
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
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Sentry API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->authToken) {
            throw new \RuntimeException('Sentry auth token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->authToken,
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
                    Log::warning("Sentry API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Sentry API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the auth token may be invalid.");
                }

                $error = $response->json('detail') ?? $response->json('error') ?? $body;
                Log::error("Sentry API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Sentry API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Sentry API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Sentry API: {$e->getMessage()}");
        }
    }
}
