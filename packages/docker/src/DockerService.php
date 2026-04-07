<?php

namespace OpenCompany\Integrations\Docker;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DockerService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://hub.docker.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List repositories for a namespace (user or org).
     *
     * @param  string  $namespace  Docker Hub namespace (username or org).
     * @param  int  $perPage  Number of repositories per page (default 25).
     * @param  int  $page  Page number (1-indexed).
     * @return array<string, mixed>
     */
    public function listRepositories(string $namespace = '', int $perPage = 25, int $page = 1): array
    {
        $params = ['page_size' => $perPage, 'page' => $page];
        if ($namespace !== '') {
            $params['namespace'] = $namespace;
        }

        return $this->request('GET', '/repositories/', $params);
    }

    /**
     * Get a single repository by namespace and name.
     *
     * @param  string  $namespace  Docker Hub namespace.
     * @param  string  $name  Repository name.
     * @return array<string, mixed>
     */
    public function getRepository(string $namespace, string $name): array
    {
        return $this->request('GET', "/repositories/{$namespace}/{$name}/");
    }

    /**
     * List tags for a repository.
     *
     * @param  string  $namespace  Docker Hub namespace.
     * @param  string  $name  Repository name.
     * @param  int  $perPage  Number of tags per page (default 25).
     * @param  int  $page  Page number (1-indexed).
     * @return array<string, mixed>
     */
    public function listTags(string $namespace, string $name, int $perPage = 25, int $page = 1): array
    {
        return $this->request('GET', "/repositories/{$namespace}/{$name}/tags/", [
            'page_size' => $perPage,
            'page' => $page,
        ]);
    }

    /**
     * Get a specific tag for a repository.
     *
     * @param  string  $namespace  Docker Hub namespace.
     * @param  string  $name  Repository name.
     * @param  string  $tag  Tag name.
     * @return array<string, mixed>
     */
    public function getTag(string $namespace, string $name, string $tag): array
    {
        return $this->request('GET', "/repositories/{$namespace}/{$name}/tags/{$tag}/");
    }

    /**
     * Create a new repository.
     *
     * @param  string  $namespace  Docker Hub namespace (user or org).
     * @param  string  $name  Repository name.
     * @param  string  $description  Short description.
     * @param  string  $fullDescription  Full README/markdown description.
     * @param  bool  $isPrivate  Whether the repository is private.
     * @return array<string, mixed>
     */
    public function createRepository(
        string $namespace,
        string $name,
        string $description = '',
        string $fullDescription = '',
        bool $isPrivate = false,
    ): array {
        $data = [
            'namespace' => $namespace,
            'name' => $name,
            'is_private' => $isPrivate,
        ];

        if ($description !== '') {
            $data['description'] = $description;
        }
        if ($fullDescription !== '') {
            $data['full_description'] = $fullDescription;
        }

        return $this->request('POST', '/repositories/', $data);
    }

    /**
     * List organizations the authenticated user belongs to.
     *
     * @param  int  $perPage  Number of organizations per page (default 25).
     * @param  int  $page  Page number (1-indexed).
     * @return array<string, mixed>
     */
    public function listOrganizations(int $perPage = 25, int $page = 1): array
    {
        return $this->request('GET', '/user/orgs/', [
            'page_size' => $perPage,
            'page' => $page,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user/');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g., "/repositories/").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Docker Hub API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Docker Hub API token is not configured.');
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
                    Log::warning("Docker Hub API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Docker Hub API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('detail') ?? $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Docker Hub API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Docker Hub API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Docker Hub API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Docker Hub API: {$e->getMessage()}");
        }
    }
}
