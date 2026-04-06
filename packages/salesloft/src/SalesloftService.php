<?php

namespace OpenCompany\Integrations\Salesloft;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SalesloftService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.salesloft.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List call sequences.
     *
     * @param  int  $limit   Maximum number of sequences to return per page.
     * @param  int  $page    Page number for pagination.
     * @param  string|null  $status  Filter by sequence status (e.g., "active", "paused").
     * @return array<string, mixed>
     */
    public function listSequences(int $limit = 25, int $page = 1, ?string $status = null): array
    {
        $params = [
            'per_page' => $limit,
            'page' => $page,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/v3/call-sequences', $params);
    }

    /**
     * Get a single call sequence by ID.
     *
     * @param  int|string  $id  The sequence ID.
     * @return array<string, mixed>
     */
    public function getSequence(int|string $id): array
    {
        return $this->request('GET', '/v3/call-sequences/' . urlencode((string) $id));
    }

    /**
     * Create a new call sequence.
     *
     * @param  array<string, mixed> $data  Sequence data (name, steps, owner_id, status, targets).
     * @return array<string, mixed>
     */
    public function createSequence(array $data): array
    {
        return $this->request('POST', '/v3/call-sequences', $data);
    }

    /**
     * List automation rules.
     *
     * @param  int  $limit  Maximum number of rules to return per page.
     * @param  int  $page   Page number for pagination.
     * @return array<string, mixed>
     */
    public function listRules(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/v3/rules', [
            'per_page' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single automation rule by ID.
     *
     * @param  int|string  $id  The rule ID.
     * @return array<string, mixed>
     */
    public function getRule(int|string $id): array
    {
        return $this->request('GET', '/v3/rules/' . urlencode((string) $id));
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v3/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Salesloft API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Salesloft access token is not configured.');
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
                    Log::warning("Salesloft API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Salesloft API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Salesloft API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Salesloft API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Salesloft API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Salesloft API: {$e->getMessage()}");
        }
    }
}
