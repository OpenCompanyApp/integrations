<?php

namespace OpenCompany\Integrations\RabbitMQ;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * RabbitMQ Management API service.
 *
 * Wraps the RabbitMQ Management HTTP API using HTTP Basic authentication.
 * Supports listing queues, exchanges, connections, vhosts, and cluster overview.
 */
class RabbitMQService
{
    /**
     * Create a new RabbitMQ service instance.
     *
     * @param string $username RabbitMQ management user username.
     * @param string $password RabbitMQ management user password.
     * @param string $baseUrl  Base URL of the RabbitMQ Management API (e.g. "https://rabbitmq.example.com").
     */
    public function __construct(
        private string $username = '',
        private string $password = '',
        private string $baseUrl = 'http://localhost:15672',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->username) && !empty($this->password);
    }

    /**
     * List all queues across all vhosts.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listQueues(): array
    {
        return $this->request('GET', '/api/queues');
    }

    /**
     * Get details for a specific queue.
     *
     * @param string $vhost Virtual host containing the queue.
     * @param string $name  Queue name.
     * @return array<string, mixed>
     */
    public function getQueue(string $vhost, string $name): array
    {
        return $this->request('GET', '/api/queues/' . $this->encodePath($vhost) . '/' . $this->encodePath($name));
    }

    /**
     * List all exchanges across all vhosts.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listExchanges(): array
    {
        return $this->request('GET', '/api/exchanges');
    }

    /**
     * List all active connections.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listConnections(): array
    {
        return $this->request('GET', '/api/connections');
    }

    /**
     * List all virtual hosts.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listVhosts(): array
    {
        return $this->request('GET', '/api/vhosts');
    }

    /**
     * Get cluster overview (node info, message rates, queue totals, listeners).
     *
     * @return array<string, mixed>
     */
    public function getOverview(): array
    {
        return $this->request('GET', '/api/overview');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE).
     * @param string $path   API path (e.g. "/api/queues").
     * @param array<string, mixed> $data Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the RabbitMQ Management API.
     *
     * @param string $method HTTP method.
     * @param string $path   API path.
     * @param array<string, mixed> $data Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->username || !$this->password) {
            throw new \RuntimeException('RabbitMQ credentials (username and password) are not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->username, $this->password)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->body();
                Log::error("RabbitMQ API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException("RabbitMQ API error ({$response->status()}): {$error}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("RabbitMQ API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to RabbitMQ API: {$e->getMessage()}");
        }
    }

    /**
     * URL-encode a path segment for use in API paths.
     *
     * RabbitMQ vhost and queue names can contain slashes and other special
     * characters that must be percent-encoded.
     *
     * @param string $segment Raw path segment.
     * @return string URL-encoded segment.
     */
    private function encodePath(string $segment): string
    {
        return rawurlencode($segment);
    }
}
