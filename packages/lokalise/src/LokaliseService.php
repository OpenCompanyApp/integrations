<?php

namespace OpenCompany\Integrations\Lokalise;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LokaliseService
{
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.lokalise.com/api2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    public function listProjects(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/projects', ['limit' => $limit, 'page' => $page]);
    }

    public function getProject(string $projectId): array
    {
        return $this->request('GET', '/projects/' . $projectId);
    }

    public function listKeys(string $projectId, int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/projects/' . $projectId . '/keys', ['limit' => $limit, 'page' => $page]);
    }

    public function getKey(string $projectId, int $keyId): array
    {
        return $this->request('GET', '/projects/' . $projectId . '/keys/' . $keyId);
    }

    public function createKey(string $projectId, array $keyData): array
    {
        return $this->request('POST', '/projects/' . $projectId . '/keys', $keyData);
    }

    public function listTranslations(string $projectId, int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/projects/' . $projectId . '/translations', ['limit' => $limit, 'page' => $page]);
    }

    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new \RuntimeException('Lokalise API token is not configured.');
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
                    Log::warning("Lokalise API returned HTML for {$method} {$path}", ['status' => $response->status()]);
                    throw new \RuntimeException("Lokalise API endpoint not available (HTTP {$response->status()}). Check the base URL configuration.");
                }

                $error = $response->json('message') ?? $response->json('error.message') ?? $response->body();
                Log::error("Lokalise API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
                throw new \RuntimeException("Lokalise API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Lokalise API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Lokalise API: {$e->getMessage()}");
        }
    }
}
