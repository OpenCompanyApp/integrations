<?php

namespace OpenCompany\Integrations\Granola;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GranolaService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.granola.ai/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List meetings for the authenticated user.
     *
     * @param  array  $params  Query parameters (e.g. limit, offset, query, start_date, end_date).
     * @return array<string, mixed>
     */
    public function listMeetings(array $params = []): array
    {
        return $this->request('GET', '/meetings', $params);
    }

    /**
     * Get a single meeting by ID, including transcript and notes.
     *
     * @param  string  $id  The meeting identifier.
     * @return array<string, mixed>
     */
    public function getMeeting(string $id): array
    {
        return $this->request('GET', '/meetings/' . urlencode($id));
    }

    /**
     * Create a note on a meeting.
     *
     * @param  string  $id  The meeting identifier.
     * @param  array<string, mixed>  $data  Note payload (e.g. content).
     * @return array<string, mixed>
     */
    public function createNote(string $id, array $data): array
    {
        return $this->request('POST', '/meetings/' . urlencode($id) . '/notes', $data);
    }

    /**
     * Share a meeting with other users.
     *
     * @param  string  $id  The meeting identifier.
     * @param  array<string, mixed>  $data  Share payload (e.g. emails, message).
     * @return array<string, mixed>
     */
    public function shareMeeting(string $id, array $data): array
    {
        return $this->request('POST', '/meetings/' . urlencode($id) . '/share', $data);
    }

    /**
     * Get the currently authenticated user's profile.
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
     * @param  string  $path  API path (e.g. /meetings).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Granola API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query or body parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On configuration, connection, or API errors.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Granola API key is not configured.');
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
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Granola API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Granola API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be down.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Granola API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Granola API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Granola API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Granola API: {$e->getMessage()}");
        }
    }
}
