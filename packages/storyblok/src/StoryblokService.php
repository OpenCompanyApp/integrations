<?php

namespace OpenCompany\Integrations\Storyblok;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StoryblokService
{
    private string $baseUrl;

    public function __construct(
        private string $accessToken = '',
        private string $spaceId = '',
        string $baseUrl = 'https://api.storyblok.com/v1',
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * Check whether the service has the minimum required credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->spaceId);
    }

    /**
     * Get the configured space ID.
     */
    public function getSpaceId(): string
    {
        return $this->spaceId;
    }

    /**
     * List stories in the configured space.
     *
     * @param  array  $params  Query parameters (page, per_page, search, sort_by, etc.).
     * @return array Parsed JSON response.
     */
    public function listStories(array $params = []): array
    {
        return $this->request('GET', "/spaces/{$this->spaceId}/stories", $params);
    }

    /**
     * Get a single story by its ID.
     *
     * @param  int|string  $id  The story ID.
     * @return array Parsed JSON response.
     */
    public function getStory(int|string $id): array
    {
        return $this->request('GET', "/spaces/{$this->spaceId}/stories/{$id}");
    }

    /**
     * Create a new story in the configured space.
     *
     * @param  array  $data  Story payload (name, slug, content, etc.).
     * @return array Parsed JSON response.
     */
    public function createStory(array $data): array
    {
        return $this->request('POST', "/spaces/{$this->spaceId}/stories", ['story' => $data]);
    }

    /**
     * Update an existing story.
     *
     * @param  int|string  $id  The story ID.
     * @param  array  $data  Fields to update (content, name, slug, etc.).
     * @return array Parsed JSON response.
     */
    public function updateStory(int|string $id, array $data): array
    {
        return $this->request('PUT', "/spaces/{$this->spaceId}/stories/{$id}", ['story' => $data]);
    }

    /**
     * Delete a story by its ID.
     *
     * @param  int|string  $id  The story ID.
     * @return array Empty array on success.
     */
    public function deleteStory(int|string $id): array
    {
        return $this->request('DELETE', "/spaces/{$this->spaceId}/stories/{$id}");
    }

    /**
     * List all components defined in the configured space.
     *
     * @return array Parsed JSON response.
     */
    public function listComponents(): array
    {
        return $this->request('GET', "/spaces/{$this->spaceId}/components");
    }

    /**
     * Get the current user / list available spaces.
     * Used as a health-check / connection-test endpoint.
     *
     * @return array Parsed JSON response.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/spaces');
    }

    /**
     * Make an API request and return parsed JSON.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($method === 'DELETE' && $response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Storyblok Management API.
     *
     * Auth header format: "Authorization: {token}" (just the token, no Bearer prefix).
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Storyblok access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => $this->accessToken,
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
                $error = $response->json() ?? $response->body();
                Log::error("Storyblok API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException(
                    "Storyblok API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Storyblok API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Storyblok API: {$e->getMessage()}");
        }
    }
}
