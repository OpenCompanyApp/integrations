<?php

namespace OpenCompany\Integrations\Thinkific;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Thinkific API service for interacting with the Thinkific online courses platform.
 *
 * Handles authentication, request formatting, and error handling for all
 * Thinkific API public v1 endpoints including courses, enrollments, and users.
 */
class ThinkificService
{
    public function __construct(
        private string $apiKey = '',
        private string $subdomain = '',
        private string $baseUrl = 'https://api.thinkific.com/api/public/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List courses with optional pagination and filtering.
     *
     * @param  int  $limit   Number of results per page (max 250).
     * @param  int  $page    Page number (1-based).
     * @param  string|null  $query  Search term to filter courses.
     * @return array<string, mixed>
     */
    public function listCourses(int $limit = 25, int $page = 1, ?string $query = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($query !== null && $query !== '') {
            $params['query'] = $query;
        }

        return $this->request('GET', '/courses', $params);
    }

    /**
     * Get a single course by its Thinkific course ID.
     *
     * @param  int  $id  The Thinkific course ID.
     * @return array<string, mixed>
     */
    public function getCourse(int $id): array
    {
        return $this->request('GET', '/courses/' . $id);
    }

    /**
     * Create a new course in Thinkific.
     *
     * @param  string  $name         The course name.
     * @param  string  $description  The course description.
     * @param  array   $additional   Additional course fields.
     * @return array<string, mixed>
     */
    public function createCourse(string $name, string $description = '', array $additional = []): array
    {
        $body = array_merge([
            'name' => $name,
            'description' => $description,
        ], $additional);

        return $this->request('POST', '/courses', [], $body);
    }

    /**
     * List enrollments with optional pagination and filtering.
     *
     * @param  int  $limit     Number of results per page (max 250).
     * @param  int  $page      Page number (1-based).
     * @param  int|null  $courseId  Filter enrollments by course ID.
     * @param  int|null  $userId    Filter enrollments by user ID.
     * @return array<string, mixed>
     */
    public function listEnrollments(int $limit = 25, int $page = 1, ?int $courseId = null, ?int $userId = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($courseId !== null) {
            $params['course_id'] = $courseId;
        }

        if ($userId !== null) {
            $params['user_id'] = $userId;
        }

        return $this->request('GET', '/enrollments', $params);
    }

    /**
     * Get a single enrollment by its Thinkific enrollment ID.
     *
     * @param  int  $id  The Thinkific enrollment ID.
     * @return array<string, mixed>
     */
    public function getEnrollment(int $id): array
    {
        return $this->request('GET', '/enrollments/' . $id);
    }

    /**
     * List users with optional pagination and filtering.
     *
     * @param  int  $limit   Number of results per page (max 250).
     * @param  int  $page    Page number (1-based).
     * @param  string|null  $query  Search term to filter users.
     * @return array<string, mixed>
     */
    public function listUsers(int $limit = 25, int $page = 1, ?string $query = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($query !== null && $query !== '') {
            $params['query'] = $query;
        }

        return $this->request('GET', '/users', $params);
    }

    /**
     * Get the currently authenticated user.
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
     * @param  string  $path    API endpoint path (e.g., "/courses").
     * @param  array  $query   Query parameters for GET requests.
     * @param  array  $body    Request body for POST/PUT requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Thinkific API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array  $query   Query parameters.
     * @param  array  $body    Request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Thinkific API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $headers = [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            if (!empty($this->subdomain)) {
                $headers['X-Auth-Subdomain'] = $this->subdomain;
            }

            $http = Http::withHeaders($headers)->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $query),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type') ?? '';
                $responseBody = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($responseBody), '<!DOCTYPE')) {
                    Log::warning("Thinkific API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Thinkific API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('errors') ?? $response->json('error') ?? $response->json('message') ?? $responseBody;
                Log::error("Thinkific API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Thinkific API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Thinkific API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Thinkific API: {$e->getMessage()}");
        }
    }
}
