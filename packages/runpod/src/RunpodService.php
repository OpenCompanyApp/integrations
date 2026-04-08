<?php

namespace OpenCompany\Integrations\Runpod;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RunpodService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.runpod.io/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all GPU pods.
     *
     * @return array<string, mixed>
     */
    public function listPods(): array
    {
        return $this->request('GET', '/pods');
    }

    /**
     * Get a single pod by ID.
     *
     * @param string $podId The pod ID
     * @return array<string, mixed>
     */
    public function getPod(string $podId): array
    {
        return $this->request('GET', "/pods/{$podId}");
    }

    /**
     * List all templates.
     *
     * @return array<string, mixed>
     */
    public function listTemplates(): array
    {
        return $this->request('GET', '/templates');
    }

    /**
     * List all network volumes.
     *
     * @return array<string, mixed>
     */
    public function listNetworkVolumes(): array
    {
        return $this->request('GET', '/network-volumes');
    }

    /**
     * List all endpoints.
     *
     * @return array<string, mixed>
     */
    public function listEndpoints(): array
    {
        return $this->request('GET', '/endpoints');
    }

    /**
     * List all serverless endpoints.
     *
     * @return array<string, mixed>
     */
    public function listServerless(): array
    {
        return $this->request('GET', '/serverless');
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE)
     * @param string $path API endpoint path
     * @param array<string, mixed> $data Request body or query parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the RunPod API.
     *
     * @param string $method HTTP method
     * @param string $path API endpoint path
     * @param array<string, mixed> $data Request body or query parameters
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is missing or the request fails
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('RunPod access token is not configured.');
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
                    Log::warning("RunPod API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("RunPod API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be down.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("RunPod API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("RunPod API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("RunPod API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to RunPod API: {$e->getMessage()}");
        }
    }
}
