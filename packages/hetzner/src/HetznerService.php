<?php

namespace OpenCompany\Integrations\Hetzner;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HetznerService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.hetzner.cloud/v1',
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
     * List servers with optional pagination.
     *
     * @param  int  $perPage  Number of servers per page (default 25).
     * @param  int  $page     Page number (1-indexed).
     * @return array<string, mixed>
     */
    public function listServers(int $perPage = 25, int $page = 1): array
    {
        return $this->request('GET', '/servers', ['per_page' => $perPage, 'page' => $page]);
    }

    /**
     * Get a single server by ID.
     *
     * @param  string  $id  The server ID.
     * @return array<string, mixed>
     */
    public function getServer(string $id): array
    {
        return $this->request('GET', '/servers/' . $id);
    }

    /**
     * Create a new server.
     *
     * @param  string  $name       Server name.
     * @param  string  $serverType Server type (e.g., "cx22").
     * @param  string  $image      Image name or ID (e.g., "ubuntu-24.04").
     * @param  string  $location   Location name (e.g., "fsn1").
     * @param  array<string, mixed>  $options  Additional options (ssh_keys, networks, etc.).
     * @return array<string, mixed>
     */
    public function createServer(string $name, string $serverType, string $image, string $location = '', array $options = []): array
    {
        $data = array_merge([
            'name' => $name,
            'server_type' => $serverType,
            'image' => $image,
        ], $options);

        if ($location !== '') {
            $data['location'] = $location;
        }

        return $this->request('POST', '/servers', $data);
    }

    /**
     * List volumes with optional pagination.
     *
     * @param  int  $perPage  Number of volumes per page (default 25).
     * @param  int  $page     Page number (1-indexed).
     * @return array<string, mixed>
     */
    public function listVolumes(int $perPage = 25, int $page = 1): array
    {
        return $this->request('GET', '/volumes', ['per_page' => $perPage, 'page' => $page]);
    }

    /**
     * List networks with optional pagination.
     *
     * @param  int  $perPage  Number of networks per page (default 25).
     * @param  int  $page     Page number (1-indexed).
     * @return array<string, mixed>
     */
    public function listNetworks(int $perPage = 25, int $page = 1): array
    {
        return $this->request('GET', '/networks', ['per_page' => $perPage, 'page' => $page]);
    }

    /**
     * List SSH keys with optional pagination.
     *
     * @param  int  $perPage  Number of SSH keys per page (default 25).
     * @param  int  $page     Page number (1-indexed).
     * @return array<string, mixed>
     */
    public function listSshKeys(int $perPage = 25, int $page = 1): array
    {
        return $this->request('GET', '/ssh_keys', ['per_page' => $perPage, 'page' => $page]);
    }

    /**
     * Get the currently authenticated user.
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
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g., "/servers").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Hetzner Cloud API.
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
            throw new \RuntimeException('Hetzner Cloud API token is not configured.');
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
                    Log::warning("Hetzner Cloud API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Hetzner Cloud API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error.message') ?? $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Hetzner Cloud API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Hetzner Cloud API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Hetzner Cloud API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Hetzner Cloud API: {$e->getMessage()}");
        }
    }
}
