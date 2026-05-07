<?php

namespace OpenCompany\Integrations\ServiceM8;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the ServiceM8 REST API.
 *
 * Maps tools to ServiceM8's api_1.0 object endpoints and handles OAuth bearer
 * authentication, errors, and JSON parsing.
 */
class ServiceM8Service
{
    /**
     * @param  string  $accessToken  ServiceM8 OAuth access token.
     * @param  string  $baseUrl  ServiceM8 API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.servicem8.com/api_1.0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the ServiceM8 integration is configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List jobs from ServiceM8.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. status, limit, offset).
     * @return array<string, mixed>
     */
    public function listJobs(array $params = []): array
    {
        return $this->request('GET', '/job.json', $params);
    }

    /**
     * Get a single job by UUID.
     *
     * @param  string  $uuid  The job UUID.
     * @return array<string, mixed>
     */
    public function getJob(string $uuid): array
    {
        return $this->request('GET', '/job/' . urlencode($uuid) . '.json');
    }

    /**
     * Create a new job in ServiceM8.
     *
     * @param  array<string, mixed>  $data  Job payload (template_id, client_id, description, etc.).
     * @return array<string, mixed>
     */
    public function createJob(array $data): array
    {
        return $this->request('POST', '/job.json', $data);
    }

    /**
     * List clients from ServiceM8.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listClients(array $params = []): array
    {
        return $this->request('GET', '/company.json', $params);
    }

    /**
     * Get a single client by UUID.
     *
     * @param  string  $uuid  The client UUID.
     * @return array<string, mixed>
     */
    public function getClient(string $uuid): array
    {
        return $this->request('GET', '/company/' . urlencode($uuid) . '.json');
    }

    /**
     * List activities from ServiceM8.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. job_uuid, limit, offset).
     * @return array<string, mixed>
     */
    public function listActivities(array $params = []): array
    {
        return $this->request('GET', '/jobactivity.json', $params);
    }

    /**
     * List staff members visible to the authenticated token.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/staff.json');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/job.json").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the ServiceM8 API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('ServiceM8 access token is not configured.');
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
                    Log::warning("ServiceM8 API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("ServiceM8 API endpoint not available (HTTP {$response->status()}). Check the base URL and access token.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("ServiceM8 API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("ServiceM8 API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ServiceM8 API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ServiceM8 API: {$e->getMessage()}");
        }
    }
}
