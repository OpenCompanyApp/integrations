<?php

namespace OpenCompany\Integrations\Notion;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Notion REST API covering pages, databases, blocks, users, and comments.
 *
 * Wraps the Notion v1 API (version 2022-06-28) and handles authentication,
 * request routing, and error reporting.
 */
class NotionService
{
    private const BASE_URL = 'https://api.notion.com/v1';
    private const NOTION_VERSION = '2022-06-28';

    /**
     * @param  string  $apiKey  Notion internal integration secret (starts with `secret_`)
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Search ─────────────────────────────────────────────

    /**
     * Search pages and databases.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function search(array $body = []): array
    {
        return $this->request('POST', '/search', $body);
    }

    // ── Pages ──────────────────────────────────────────────

    /**
     * Create a page.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function createPage(array $body): array
    {
        return $this->request('POST', '/pages', $body);
    }

    /**
     * Get a page.
     *
     * @return array<string, mixed>
     */
    public function getPage(string $pageId): array
    {
        return $this->request('GET', "/pages/{$pageId}");
    }

    /**
     * Update a page.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function updatePage(string $pageId, array $body): array
    {
        return $this->request('PATCH', "/pages/{$pageId}", $body);
    }

    // ── Databases ──────────────────────────────────────────

    /**
     * Create a database.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function createDatabase(array $body): array
    {
        return $this->request('POST', '/databases', $body);
    }

    /**
     * Get a database.
     *
     * @return array<string, mixed>
     */
    public function getDatabase(string $databaseId): array
    {
        return $this->request('GET', "/databases/{$databaseId}");
    }

    /**
     * Update a database.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function updateDatabase(string $databaseId, array $body): array
    {
        return $this->request('PATCH', "/databases/{$databaseId}", $body);
    }

    /**
     * Query a database.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function queryDatabase(string $databaseId, array $body = []): array
    {
        return $this->request('POST', "/databases/{$databaseId}/query", $body);
    }

    // ── Blocks ─────────────────────────────────────────────

    /**
     * Get block children.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getBlockChildren(string $blockId, array $params = []): array
    {
        return $this->request('GET', "/blocks/{$blockId}/children", $params);
    }

    /**
     * Append block children.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function appendBlockChildren(string $blockId, array $body): array
    {
        return $this->request('PATCH', "/blocks/{$blockId}/children", $body);
    }

    /**
     * Get a block.
     *
     * @return array<string, mixed>
     */
    public function getBlock(string $blockId): array
    {
        return $this->request('GET', "/blocks/{$blockId}");
    }

    /**
     * Update a block.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function updateBlock(string $blockId, array $body): array
    {
        return $this->request('PATCH', "/blocks/{$blockId}", $body);
    }

    /**
     * Delete a block.
     *
     * @return array<string, mixed>
     */
    public function deleteBlock(string $blockId): array
    {
        return $this->request('DELETE', "/blocks/{$blockId}");
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * Get the current user (bot).
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * List all users.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * Get a user.
     *
     * @return array<string, mixed>
     */
    public function getUser(string $userId): array
    {
        return $this->request('GET', "/users/{$userId}");
    }

    // ── Comments ───────────────────────────────────────────

    /**
     * Create a comment.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function createComment(array $body): array
    {
        return $this->request('POST', '/comments', $body);
    }

    /**
     * Get comments.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getComments(string $blockId, array $params = []): array
    {
        $params['block_id'] = $blockId;

        return $this->request('GET', '/comments', $params);
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Notion API key is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Notion-Version' => self::NOTION_VERSION,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get(self::BASE_URL . $path, $data),
                'POST' => $http->post(self::BASE_URL . $path, $data),
                'PATCH' => $http->patch(self::BASE_URL . $path, $data),
                'DELETE' => $http->delete(self::BASE_URL . $path, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['message'] ?? $body['code'] ?? $response->body();

                Log::error("Notion API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $err,
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Notion API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Notion API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Notion API: {$e->getMessage()}");
        }
    }
}
