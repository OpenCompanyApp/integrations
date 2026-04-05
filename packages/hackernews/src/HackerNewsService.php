<?php

namespace OpenCompany\Integrations\HackerNews;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Hacker News API service — wraps the public Firebase HN API.
 *
 * No authentication is required. All endpoints are publicly accessible.
 *
 * @see https://github.com/HackerNews/API
 */
class HackerNewsService
{
    /**
     * @param  string  $baseUrl  Base URL for the HN API (configurable for testing/self-hosted)
     */
    public function __construct(
        private string $baseUrl = 'https://hacker-news.firebaseio.com/v0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * The service is always configured — the HN API requires no credentials.
     */
    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Fetch a single item (story, comment, job, poll, etc.) by its ID.
     *
     * @param  int  $id  The HN item ID
     * @return array<string, mixed>|null The item data, or null if not found
     */
    public function getItem(int $id): ?array
    {
        return $this->request('GET', "/item/{$id}.json");
    }

    /**
     * Fetch a user profile by username.
     *
     * @param  string  $id  The HN username
     * @return array<string, mixed>|null The user data, or null if not found
     */
    public function getUser(string $id): ?array
    {
        return $this->request('GET', "/user/{$id}.json");
    }

    /**
     * Fetch the list of top story IDs (up to ~500).
     *
     * @return int[] Array of item IDs
     */
    public function topStories(): array
    {
        return $this->request('GET', '/topstories.json') ?? [];
    }

    /**
     * Fetch the list of new story IDs (up to ~500).
     *
     * @return int[] Array of item IDs
     */
    public function newStories(): array
    {
        return $this->request('GET', '/newstories.json') ?? [];
    }

    /**
     * Fetch the list of best story IDs (up to ~500).
     *
     * @return int[] Array of item IDs
     */
    public function bestStories(): array
    {
        return $this->request('GET', '/beststories.json') ?? [];
    }

    /**
     * Fetch multiple items by ID and return their full data.
     *
     * @param  int[]  $ids  Array of item IDs to fetch
     * @param  int    $limit  Maximum number of items to return
     * @return array<int, array<string, mixed>> Array of item data
     */
    public function fetchItems(array $ids, int $limit = 30): array
    {
        $ids = array_slice($ids, 0, $limit);
        $items = [];

        foreach ($ids as $id) {
            $item = $this->getItem((int) $id);
            if ($item !== null) {
                $items[] = $item;
            }
        }

        return $items;
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, etc.)
     * @param  string  $path    API endpoint path (e.g., "/item/123.json")
     * @return mixed Parsed JSON response or null
     */
    private function request(string $method, string $path): mixed
    {
        $url = $this->baseUrl . $path;

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->timeout(30)->{strtolower($method)}($url);

            if (!$response->successful()) {
                Log::error("Hacker News API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return null;
            }

            return $response->json();
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Hacker News API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }
}
