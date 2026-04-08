<?php

namespace OpenCompany\Integrations\ArgoCd;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Argo CD API.
 *
 * Provides methods for applications, projects, repositories,
 * and user management via the Argo CD GitOps platform.
 */
class ArgoCdService
{
    private const DEFAULT_BASE_URL = 'https://api.argocd.io/v1';

    /**
     * @param  string  $token  Argo CD Bearer token
     * @param  string  $baseUrl  Argo CD API base URL
     */
    public function __construct(
        private string $token = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {}

    /**
     * Check whether the Argo CD token has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->token);
    }

    /*-----------------------------------------------------------------------
     | Applications
     *---------------------------------------------------------------------*/

    public function listApplications(array $params = []): array
    {
        return $this->request('GET', '/applications', $params);
    }

    public function getApplication(string $name, array $params = []): array
    {
        return $this->request('GET', "/applications/{$name}", $params);
    }

    public function createApplication(array $params): array
    {
        return $this->request('POST', '/applications', $params);
    }

    /*-----------------------------------------------------------------------
     | Projects
     *---------------------------------------------------------------------*/

    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/projects', $params);
    }

    public function getProject(string $name): array
    {
        return $this->request('GET', "/projects/{$name}");
    }

    /*-----------------------------------------------------------------------
     | Repositories
     *---------------------------------------------------------------------*/

    public function listRepositories(array $params = []): array
    {
        return $this->request('GET', '/repositories', $params);
    }

    /*-----------------------------------------------------------------------
     | User
     *---------------------------------------------------------------------*/

    public function getCurrentUser(): array
    {
        return $this->request('GET', '/session/userinfo');
    }

    /*-----------------------------------------------------------------------
     | Core HTTP
     *---------------------------------------------------------------------*/

    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->token) {
            throw new \RuntimeException('Argo CD token is not configured.');
        }

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        $baseUrl = rtrim($this->baseUrl, '/');
        $url = $baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->token}",
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'PATCH' => $http->patch($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->status() === 429) {
                throw new \RuntimeException('Argo CD rate limit exceeded.');
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $body['error'] ?? $response->body();

                Log::error("Argo CD API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'Argo CD API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            if ($response->status() === 204 || $response->body() === '') {
                return ['success' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Argo CD API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Argo CD API: {$e->getMessage()}");
        }
    }
}
