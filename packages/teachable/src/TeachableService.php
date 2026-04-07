<?php

namespace OpenCompany\Integrations\Teachable;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for interacting with the Teachable API v1.
 *
 * Handles authentication via Bearer token and provides methods for all
 * Teachable API endpoints including courses, users, and enrollments.
 */
class TeachableService
{
    /**
     * Create a new TeachableService instance.
     *
     * @param  string  $apiKey  The Teachable API key for Bearer token authentication.
     * @param  string  $baseUrl  The Teachable API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.teachable.com/v1',
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
     * List courses.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, per_page, etc.).
     * @return array<string, mixed>
     */
    public function listCourses(array $params = []): array
    {
        return $this->request('GET', '/courses', $params);
    }

    /**
     * Get a single course by ID.
     *
     * @return array<string, mixed>
     */
    public function getCourse(string $courseId): array
    {
        return $this->request('GET', "/courses/{$courseId}");
    }

    /**
     * List users.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, per_page, etc.).
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * Get a single user by ID.
     *
     * @return array<string, mixed>
     */
    public function getUser(string $userId): array
    {
        return $this->request('GET', "/users/{$userId}");
    }

    /**
     * List enrollments.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, per_page, user_id, course_id, etc.).
     * @return array<string, mixed>
     */
    public function listEnrollments(array $params = []): array
    {
        return $this->request('GET', '/enrollments', $params);
    }

    /**
     * Get a single enrollment by ID.
     *
     * @return array<string, mixed>
     */
    public function getEnrollment(string $enrollmentId): array
    {
        return $this->request('GET', "/enrollments/{$enrollmentId}");
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST/PATCH/DELETE).
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
     * Make a raw HTTP request to the Teachable API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Teachable API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("Teachable API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Teachable API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Teachable API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Teachable API: {$e->getMessage()}");
        }
    }
}
