<?php

namespace OpenCompany\Integrations\Gainsight;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Gainsight API service for interacting with the Gainsight customer success platform.
 *
 * Handles HTTP communication with the Gainsight REST API using Bearer
 * token authentication. Provides methods for listing and retrieving
 * companies, users, and surveys.
 */
class GainsightService
{
    /**
     * Create a new GainsightService instance.
     *
     * @param  string  $accessToken  The Gainsight API access token.
     * @param  string  $baseUrl  The Gainsight API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.gainsight.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Gainsight integration is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List companies from Gainsight.
     *
     * @param  array  $filters  Optional filters (page, limit, search, etc.).
     * @return array The API response containing company objects.
     */
    public function listCompanies(array $filters = []): array
    {
        return $this->request('GET', '/companies', $filters);
    }

    /**
     * Get a single company by its ID.
     *
     * @param  string  $companyId  The unique company identifier.
     * @return array The company object.
     */
    public function getCompany(string $companyId): array
    {
        return $this->request('GET', '/companies/' . urlencode($companyId));
    }

    /**
     * List users from Gainsight.
     *
     * @param  array  $filters  Optional filters (page, limit, etc.).
     * @return array The API response containing user objects.
     */
    public function listUsers(array $filters = []): array
    {
        return $this->request('GET', '/users', $filters);
    }

    /**
     * Get a single user by their ID.
     *
     * @param  string  $userId  The unique user identifier.
     * @return array The user object.
     */
    public function getUser(string $userId): array
    {
        return $this->request('GET', '/users/' . urlencode($userId));
    }

    /**
     * List surveys from Gainsight.
     *
     * @param  array  $filters  Optional filters (page, limit, status, etc.).
     * @return array The API response containing survey objects.
     */
    public function listSurveys(array $filters = []): array
    {
        return $this->request('GET', '/surveys', $filters);
    }

    /**
     * Get a single survey by its ID.
     *
     * @param  string  $surveyId  The unique survey identifier.
     * @return array The survey object.
     */
    public function getSurvey(string $surveyId): array
    {
        return $this->request('GET', '/surveys/' . urlencode($surveyId));
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array The current user object.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path.
     * @param  array  $data  Request body or query parameters.
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Gainsight API using Bearer token authentication.
     *
     * @param  string  $method  The HTTP method.
     * @param  string  $path  The API endpoint path.
     * @param  array  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If credentials are missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Gainsight API access token is not configured.');
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
                    Log::warning("Gainsight API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Gainsight API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('errors') ?? $body;
                Log::error("Gainsight API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Gainsight API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Gainsight API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Gainsight API: {$e->getMessage()}");
        }
    }
}
