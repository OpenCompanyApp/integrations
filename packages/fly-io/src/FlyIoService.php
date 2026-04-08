<?php

namespace OpenCompany\Integrations\FlyIo;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FlyIoService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.machines.dev/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    // User
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    // Apps
    public function listApps(): array
    {
        return $this->request('GET', '/apps');
    }

    public function getApp(string $appName): array
    {
        return $this->request('GET', '/apps/' . urlencode($appName));
    }

    public function createApp(array $params): array
    {
        return $this->request('POST', '/apps', $params);
    }

    // Machines
    public function listMachines(string $appName): array
    {
        return $this->request('GET', '/apps/' . urlencode($appName) . '/machines');
    }

    public function getMachine(string $appName, string $machineId): array
    {
        return $this->request('GET', '/apps/' . urlencode($appName) . '/machines/' . $machineId);
    }

    // Volumes
    public function listVolumes(string $appName): array
    {
        return $this->request('GET', '/apps/' . urlencode($appName) . '/volumes');
    }

    // HTTP helpers
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        if ($method === 'DELETE') { return []; }
        return $response->json() ?? [];
    }

    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Fly.io access token is not configured.');
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

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Fly.io API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Fly.io API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("Fly.io API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Fly.io API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Fly.io API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Fly.io API: {$e->getMessage()}");
        }
    }
}
