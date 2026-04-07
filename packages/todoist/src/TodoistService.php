<?php

namespace OpenCompany\Integrations\Todoist;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TodoistService
{
    private const BASE_URL = 'https://api.todoist.com/rest/v2';

    public function __construct(
        private string $accessToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    public function testConnection(): array
    {
        return $this->request('GET', '/user');
    }

    // ── Tasks ───────────────────────────────────────────────

    public function createTask(array $data): array
    {
        return $this->request('POST', '/tasks', $data);
    }

    public function getTask(string $id): array
    {
        return $this->request('GET', "/tasks/{$id}");
    }

    public function listTasks(array $params = []): array
    {
        return $this->request('GET', '/tasks', $params);
    }

    // ── Projects ────────────────────────────────────────────

    public function getProject(string $id): array
    {
        return $this->request('GET', "/projects/{$id}");
    }

    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/projects', $params);
    }

    // ── Labels ──────────────────────────────────────────────

    public function listLabels(array $params = []): array
    {
        return $this->request('GET', '/labels', $params);
    }

    // ── User ────────────────────────────────────────────────

    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    // ── HTTP ─────────────────────────────────────────────────

    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Todoist access token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                Log::error("Todoist API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                throw new \RuntimeException("Todoist API error ({$response->status()}): {$response->body()}");
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Todoist API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Todoist API: {$e->getMessage()}");
        }
    }
}
