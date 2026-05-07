<?php

namespace OpenCompany\Integrations\Supabase;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Supabase Management API.
 *
 * Handles bearer-token authentication, project and organization management
 * endpoints, and normalized error handling for agent-facing tools.
 */
class SupabaseService
{
    /**
     * @param  string  $accessToken  Supabase personal access token or OAuth access token.
     * @param  string  $baseUrl  Supabase Management API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.supabase.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Get the currently authenticated Supabase user profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/profile');
    }

    /**
     * List all projects visible to the authenticated account.
     *
     * @return array<string, mixed>|list<array<string, mixed>>
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/projects');
    }

    /**
     * Get a specific project by project ref.
     *
     * @return array<string, mixed>
     */
    public function getProject(string $ref): array
    {
        return $this->request('GET', '/projects/' . rawurlencode($ref));
    }

    /**
     * Create a Supabase project.
     *
     * @param  array<string, mixed>  $payload  Project creation body.
     * @return array<string, mixed>
     */
    public function createProject(array $payload): array
    {
        return $this->request('POST', '/projects', body: $payload);
    }

    /**
     * Delete a Supabase project by project ref.
     *
     * @return array<string, mixed>
     */
    public function deleteProject(string $ref): array
    {
        return $this->request('DELETE', '/projects/' . rawurlencode($ref));
    }

    /**
     * List organizations visible to the authenticated account.
     *
     * @return array<string, mixed>|list<array<string, mixed>>
     */
    public function listOrganizations(): array
    {
        return $this->request('GET', '/organizations');
    }

    /**
     * Get a Supabase organization by slug.
     *
     * @return array<string, mixed>
     */
    public function getOrganization(string $slug): array
    {
        return $this->request('GET', '/organizations/' . rawurlencode($slug));
    }

    /**
     * List members of a Supabase organization.
     *
     * @return array<string, mixed>|list<array<string, mixed>>
     */
    public function listOrganizationMembers(string $slug): array
    {
        return $this->request('GET', '/organizations/' . rawurlencode($slug) . '/members');
    }

    /**
     * List projects for a Supabase organization.
     *
     * @param  array<string, mixed>  $params  Query parameters such as offset and limit.
     * @return array<string, mixed>|list<array<string, mixed>>
     */
    public function listOrganizationProjects(string $slug, array $params = []): array
    {
        return $this->request('GET', '/organizations/' . rawurlencode($slug) . '/projects', $params);
    }

    /**
     * Get API keys for a Supabase project.
     *
     * @return array<string, mixed>|list<array<string, mixed>>
     */
    public function getProjectApiKeys(string $ref): array
    {
        return $this->request('GET', '/projects/' . rawurlencode($ref) . '/api-keys');
    }

    /**
     * Make an API request and return parsed output.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  mixed  $body  Request body.
     * @return array<string, mixed>|list<array<string, mixed>>
     */
    private function request(string $method, string $path, array $query = [], mixed $body = null): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204 || $response->body() === '') {
            return [];
        }

        $contentType = (string) $response->header('Content-Type');
        if ($contentType !== '' && !str_contains($contentType, 'json')) {
            return [
                'body' => $response->body(),
                'content_type' => $contentType,
            ];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Supabase Management API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  mixed  $body  Request body.
     */
    private function rawRequest(string $method, string $path, array $query = [], mixed $body = null): Response
    {
        if ($this->accessToken === '') {
            throw new \RuntimeException('Supabase access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withToken($this->accessToken)
                ->acceptJson()
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $query),
                'POST' => $http->post($url . $this->queryString($query), $body ?? []),
                'PUT' => $http->put($url . $this->queryString($query), $body ?? []),
                'PATCH' => $http->patch($url . $this->queryString($query), $body ?? []),
                'DELETE' => $http->delete($url . $this->queryString($query), is_array($body) ? $body : []),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('msg') ?? $response->json('error') ?? $response->body();

                Log::error("Supabase API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException('Supabase API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Supabase API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Supabase API: {$e->getMessage()}");
        }
    }

    /**
     * Build a URL query suffix for non-GET requests.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function queryString(array $query): string
    {
        if ($query === []) {
            return '';
        }

        return '?' . http_build_query($query);
    }
}
