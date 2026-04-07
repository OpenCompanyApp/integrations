<?php

namespace OpenCompany\Integrations\Upcloud;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpcloudService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.upcloud.com/1.3',
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
     * List servers.
     *
     * @return array<string, mixed>
     */
    public function listServers(): array
    {
        return $this->request('GET', '/server');
    }

    /**
     * Get a single server by UUID.
     *
     * @param  string  $uuid  The server UUID.
     * @return array<string, mixed>
     */
    public function getServer(string $uuid): array
    {
        return $this->request('GET', '/server/' . $uuid);
    }

    /**
     * List storages.
     *
     * @param  string  $type  Storage type filter (e.g., "disk", "backup", "cdrom").
     * @return array<string, mixed>
     */
    public function listStorages(string $type = ''): array
    {
        $path = '/storage';
        if ($type !== '') {
            $path .= '/' . $type;
        }
        return $this->request('GET', $path);
    }

    /**
     * List networks.
     *
     * @return array<string, mixed>
     */
    public function listNetworks(): array
    {
        return $this->request('GET', '/network');
    }

    /**
     * List IP addresses.
     *
     * @return array<string, mixed>
     */
    public function listIps(): array
    {
        return $this->request('GET', '/ip_address');
    }

    /**
     * List available zones.
     *
     * @return array<string, mixed>
     */
    public function listZones(): array
    {
        return $this->request('GET', '/zone');
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/account');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g., "/server").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the UpCloud API.
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
            throw new \RuntimeException('UpCloud access token is not configured.');
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
                    Log::warning("UpCloud API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("UpCloud API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('error_message') ?? $response->json('message') ?? $body;
                Log::error("UpCloud API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("UpCloud API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("UpCloud API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to UpCloud API: {$e->getMessage()}");
        }
    }
}
