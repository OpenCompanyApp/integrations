<?php

namespace OpenCompany\Integrations\Weave;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeaveService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.getweave.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Weave integration is configured (has an access token).
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List patients with optional pagination and search.
     *
     * @param  int  $limit  Maximum number of patients to return.
     * @param  int  $page   Page number for pagination (1-based).
     * @param  string|null  $query  Search query to filter patients.
     * @return array<string, mixed>
     */
    public function listPatients(int $limit = 25, int $page = 1, ?string $query = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($query !== null) {
            $params['query'] = $query;
        }

        return $this->request('GET', '/api/v1/patients', $params);
    }

    /**
     * Get a single patient by ID.
     *
     * @param  string  $id  The patient identifier.
     * @return array<string, mixed>
     */
    public function getPatient(string $id): array
    {
        return $this->request('GET', '/api/v1/patients/' . urlencode($id));
    }

    /**
     * List appointments with optional date range filtering and pagination.
     *
     * @param  string|null  $startDate  Start date for the range (ISO 8601, e.g. "2025-01-01").
     * @param  string|null  $endDate    End date for the range (ISO 8601, e.g. "2025-01-31").
     * @param  int  $limit   Maximum number of appointments to return.
     * @return array<string, mixed>
     */
    public function listAppointments(?string $startDate = null, ?string $endDate = null, int $limit = 25): array
    {
        $params = ['limit' => $limit];

        if ($startDate !== null) {
            $params['startDate'] = $startDate;
        }

        if ($endDate !== null) {
            $params['endDate'] = $endDate;
        }

        return $this->request('GET', '/api/v1/appointments', $params);
    }

    /**
     * Get a single appointment by ID.
     *
     * @param  string  $id  The appointment identifier.
     * @return array<string, mixed>
     */
    public function getAppointment(string $id): array
    {
        return $this->request('GET', '/api/v1/appointments/' . urlencode($id));
    }

    /**
     * List messages with optional pagination and type filtering.
     *
     * @param  int  $limit   Maximum number of messages to return.
     * @param  int  $page    Page number for pagination (1-based).
     * @param  string|null  $type  Filter by message type (e.g. "sms", "email").
     * @return array<string, mixed>
     */
    public function listMessages(int $limit = 25, int $page = 1, ?string $type = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($type !== null) {
            $params['type'] = $type;
        }

        return $this->request('GET', '/api/v1/messages', $params);
    }

    /**
     * Get a single message by ID.
     *
     * @param  string  $id  The message identifier.
     * @return array<string, mixed>
     */
    public function getMessage(string $id): array
    {
        return $this->request('GET', '/api/v1/messages/' . urlencode($id));
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v1/users/me');
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
     * Make a raw HTTP request to the Weave API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Weave access token is not configured.');
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
                    Log::warning("Weave API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Weave API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Weave API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Weave API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Weave API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Weave API: {$e->getMessage()}");
        }
    }
}
