<?php

namespace OpenCompany\Integrations\Agora;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AgoraService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.agora.io/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List all projects.
     *
     * @return array<string, mixed>
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/projects');
    }

    /**
     * Get a single project by ID.
     *
     * @param  string  $projectId  The project ID.
     * @return array<string, mixed>
     */
    public function getProject(string $projectId): array
    {
        return $this->request('GET', '/projects/' . urlencode($projectId));
    }

    /**
     * Create a new project.
     *
     * @param  array<string, mixed>  $data  Project data (name, etc.).
     * @return array<string, mixed>
     */
    public function createProject(array $data = []): array
    {
        return $this->request('POST', '/projects', $data);
    }

    /**
     * List recordings with optional filters.
     *
     * @param  array<string, mixed>  $filters  Query filters (resourceid, mode, etc.).
     * @return array<string, mixed>
     */
    public function listRecordings(array $filters = []): array
    {
        return $this->request('GET', '/recordings', $filters);
    }

    /**
     * Get a single recording by ID.
     *
     * @param  string  $recordingId  The recording ID (sid).
     * @return array<string, mixed>
     */
    public function getRecording(string $recordingId): array
    {
        return $this->request('GET', '/recordings/' . urlencode($recordingId));
    }

    /**
     * Start a recording for a given resource.
     *
     * @param  array<string, mixed>  $data  Recording parameters (cname, uid, clientRequest, etc.).
     * @return array<string, mixed>
     */
    public function startRecording(array $data): array
    {
        return $this->request('POST', '/recordings/start', $data);
    }

    /**
     * Get the current authenticated user.
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
     * @param  string  $path    API path (e.g. /projects).
     * @param  array<string, mixed>  $data  Query params (GET) or body (POST/PUT/DELETE).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Agora API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Agora API key is not configured.');
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
                    Log::warning("Agora API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Agora API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Agora API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Agora API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Agora API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Agora API: {$e->getMessage()}");
        }
    }
}
