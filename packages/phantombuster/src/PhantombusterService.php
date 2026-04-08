<?php

namespace OpenCompany\Integrations\Phantombuster;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PhantombusterService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.phantombuster.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
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
     * List all agents.
     *
     * @return array<string, mixed>
     */
    public function listAgents(): array
    {
        return $this->request('GET', '/agents/fetch-all');
    }

    /**
     * Get a single agent by ID.
     *
     * @return array<string, mixed>
     */
    public function getAgent(string $id): array
    {
        return $this->request('GET', '/agents/fetch/' . urlencode($id));
    }

    /**
     * Launch an agent by ID.
     *
     * @param  string  $id  The agent ID to launch.
     * @return array<string, mixed>
     */
    public function launchAgent(string $id): array
    {
        return $this->request('POST', '/agents/launch', [
            'id' => $id,
        ]);
    }

    /**
     * List all containers.
     *
     * @return array<string, mixed>
     */
    public function listContainers(): array
    {
        return $this->request('GET', '/containers/fetch-all');
    }

    /**
     * Get a single container by ID.
     *
     * @return array<string, mixed>
     */
    public function getContainer(string $id): array
    {
        return $this->request('GET', '/containers/fetch/' . urlencode($id));
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
     * Make a raw HTTP request to the Phantombuster API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Phantombuster API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Phantombuster-Key' => $this->apiKey,
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
                    Log::warning("Phantombuster API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Phantombuster API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Phantombuster API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Phantombuster API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Phantombuster API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Phantombuster API: {$e->getMessage()}");
        }
    }
}
