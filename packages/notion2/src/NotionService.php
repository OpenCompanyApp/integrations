<?php

namespace OpenCompany\Integrations\Notion2;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Notion REST API.
 */
class NotionService
{
    private const BASE_URL = 'https://api.notion.com/v1';

    public function __construct(
        private string $accessToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Connection ──────────────────────────────────────────

    public function testConnection(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── Pages ───────────────────────────────────────────────

    public function listPages(array $params = []): array
    {
        return $this->request('POST', '/search', $params);
    }

    public function getPage(string $id): array
    {
        return $this->request('GET', "/pages/{$id}");
    }

    public function createPage(array $data): array
    {
        return $this->request('POST', '/pages', $data);
    }

    // ── Databases ───────────────────────────────────────────

    public function listDatabases(array $params = []): array
    {
        $params['filter'] = $params['filter'] ?? ['property' => 'object', 'value' => 'database'];
        return $this->request('POST', '/search', $params);
    }

    public function queryDatabase(string $id, array $params = []): array
    {
        return $this->request('POST', "/databases/{$id}/query", $params);
    }

    // ── Users ───────────────────────────────────────────────

    public function listUsers(): array
    {
        return $this->request('GET', '/users');
    }

    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── HTTP ─────────────────────────────────────────────────

    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Notion access token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Notion-Version' => '2022-06-28',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                Log::error("Notion API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                throw new \RuntimeException("Notion API error ({$response->status()}): {$response->body()}");
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Notion API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Notion API: {$e->getMessage()}");
        }
    }
}
