<?php

namespace OpenCompany\Integrations\Abyssale;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AbyssaleService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.abyssale.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List generations with optional pagination and status filter.
     *
     * @param  int  $page   Page number (1-based).
     * @param  int  $limit  Results per page.
     * @param  string|null  $status  Filter by status (e.g. "finished", "processing", "failed").
     * @return array<string, mixed>
     */
    public function listGenerations(int $page = 1, int $limit = 20, ?string $status = null): array
    {
        $params = [
            'page' => $page,
            'limit' => $limit,
        ];
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/v2/generations', $params);
    }

    /**
     * Get a single generation by ID.
     *
     * @param  string  $id  The generation UUID.
     * @return array<string, mixed>
     */
    public function getGeneration(string $id): array
    {
        return $this->request('GET', '/v2/generations/' . urlencode($id));
    }

    /**
     * Create a new image generation.
     *
     * @param  string  $templateId  The template UUID.
     * @param  array<string>  $formatIds  Format UUIDs to generate.
     * @param  array<string, mixed>  $modifications  Element modifications to apply.
     * @return array<string, mixed>
     */
    public function createGeneration(string $templateId, array $formatIds, array $modifications = []): array
    {
        $body = [
            'template_id' => $templateId,
            'format_ids' => $formatIds,
        ];
        if (!empty($modifications)) {
            $body['modifications'] = $modifications;
        }

        return $this->request('POST', '/v2/generations', $body);
    }

    /**
     * List templates with optional pagination.
     *
     * @param  int  $page   Page number (1-based).
     * @param  int  $limit  Results per page.
     * @return array<string, mixed>
     */
    public function listTemplates(int $page = 1, int $limit = 20): array
    {
        return $this->request('GET', '/v2/templates', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get a single template by ID.
     *
     * @param  string  $id  The template UUID.
     * @return array<string, mixed>
     */
    public function getTemplate(string $id): array
    {
        return $this->request('GET', '/v2/templates/' . urlencode($id));
    }

    /**
     * List formats with optional pagination.
     *
     * @param  int  $page   Page number (1-based).
     * @param  int  $limit  Results per page.
     * @return array<string, mixed>
     */
    public function listFormats(int $page = 1, int $limit = 20): array
    {
        return $this->request('GET', '/v2/formats', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g. /v2/generations).
     * @param  array<string, mixed>  $data  Query params (GET) or body (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Abyssale API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Abyssale access token is not configured.');
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
                    Log::warning("Abyssale API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Abyssale API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Abyssale API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Abyssale API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Abyssale API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Abyssale API: {$e->getMessage()}");
        }
    }
}
