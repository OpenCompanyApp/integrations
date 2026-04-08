<?php

namespace OpenCompany\Integrations\Immigrant;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Immigrant API service — handles authentication and HTTP requests.
 *
 * Communicates with the Immigrant REST API using Bearer token authentication.
 * Base URL: https://api.immigration.com/v1
 */
class ImmigrantService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.immigration.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->baseUrl);
    }

    /**
     * Get the configured base URL.
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * List immigration applications with optional filtering and pagination.
     *
     * @param  int  $limit   Number of results per page (default 25, max 100).
     * @param  int  $page    Page number for pagination (1-based).
     * @param  string|null  $status  Filter by application status.
     * @return array<string, mixed>
     */
    public function listApplications(int $limit = 25, int $page = 1, ?string $status = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/applications', $params);
    }

    /**
     * Get a single immigration application by its ID.
     *
     * @param  string  $applicationId  The Immigrant application ID.
     * @return array<string, mixed>
     */
    public function getApplication(string $applicationId): array
    {
        return $this->request('GET', '/applications/' . $applicationId);
    }

    /**
     * Create a new immigration application.
     *
     * @param  string  $type             Application type (e.g. "visa", "green_card", "citizenship").
     * @param  string  $applicantName    Full name of the applicant.
     * @param  array|null  $details      Additional application details.
     * @return array<string, mixed>
     */
    public function createApplication(string $type, string $applicantName, ?array $details = null): array
    {
        $data = [
            'type' => $type,
            'applicant_name' => $applicantName,
        ];

        if ($details !== null) {
            $data['details'] = $details;
        }

        return $this->request('POST', '/applications', $data);
    }

    /**
     * List documents for an immigration application.
     *
     * @param  string  $applicationId  The Immigrant application ID.
     * @param  int  $limit             Number of results per page (default 25).
     * @param  int  $page              Page number for pagination (1-based).
     * @return array<string, mixed>
     */
    public function listDocuments(string $applicationId, int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/applications/' . $applicationId . '/documents', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single document by its ID.
     *
     * @param  string  $documentId  The Immigrant document ID.
     * @return array<string, mixed>
     */
    public function getDocument(string $documentId): array
    {
        return $this->request('GET', '/documents/' . $documentId);
    }

    /**
     * List available application statuses.
     *
     * @return array<string, mixed>
     */
    public function listStatuses(): array
    {
        return $this->request('GET', '/statuses');
    }

    /**
     * Get the currently authenticated Immigrant user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/applications").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Immigrant API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When credentials are missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken || !$this->baseUrl) {
            throw new \RuntimeException('Immigrant integration is not configured. Provide an access token.');
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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Immigrant API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Immigrant API endpoint not available (HTTP {$response->status()}). Check your credentials.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Immigrant API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Immigrant API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Immigrant API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Immigrant API: {$e->getMessage()}");
        }
    }
}
