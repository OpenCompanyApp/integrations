<?php

namespace OpenCompany\Integrations\Canny;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Canny API.
 *
 * Handles API-key injection, documented v1/v2 endpoint mapping, JSON response
 * parsing, and normalized API errors for all Canny tools.
 */
class CannyService
{
    private const DEFAULT_BASE_URL = 'https://canny.io';

    private const OPERATIONS = [
        'retrieve_board' => '/api/v1/boards/retrieve',
        'list_boards' => '/api/v1/boards/list',
        'retrieve_category' => '/api/v1/categories/retrieve',
        'list_categories' => '/api/v1/categories/list',
        'create_category' => '/api/v1/categories/create',
        'delete_category' => '/api/v1/categories/delete',
        'create_entry' => '/api/v1/entries/create',
        'list_entries' => '/api/v1/entries/list',
        'retrieve_comment' => '/api/v1/comments/retrieve',
        'list_comments' => '/api/v2/comments/list',
        'create_comment' => '/api/v1/comments/create',
        'delete_comment' => '/api/v1/comments/delete',
        'list_companies' => '/api/v2/companies/list',
        'update_company' => '/api/v1/companies/update',
        'delete_company' => '/api/v1/companies/delete',
        'list_groups' => '/api/v1/groups/list',
        'retrieve_group' => '/api/v1/groups/retrieve',
        'list_ideas' => '/api/v1/ideas/list',
        'merge_idea' => '/api/v1/ideas/merge',
        'retrieve_idea' => '/api/v1/ideas/retrieve',
        'delete_idea' => '/api/v1/ideas/delete',
        'list_insights' => '/api/v1/insights/list',
        'retrieve_insight' => '/api/v1/insights/retrieve',
        'list_opportunities' => '/api/v1/opportunities/list',
        'retrieve_post' => '/api/v1/posts/retrieve',
        'list_posts' => '/api/v1/posts/list',
        'create_post' => '/api/v1/posts/create',
        'change_post_board' => '/api/v1/posts/change_board',
        'change_post_category' => '/api/v1/posts/change_category',
        'change_post_status' => '/api/v1/posts/change_status',
        'merge_post' => '/api/v1/posts/merge',
        'add_post_tag' => '/api/v1/posts/add_tag',
        'remove_post_tag' => '/api/v1/posts/remove_tag',
        'update_post' => '/api/v1/posts/update',
        'delete_post' => '/api/v1/posts/delete',
        'link_jira_issue' => '/api/v1/posts/link_jira',
        'unlink_jira_issue' => '/api/v1/posts/unlink_jira',
        'list_status_changes' => '/api/v2/status_changes/list',
        'retrieve_tag' => '/api/v1/tags/retrieve',
        'list_tags' => '/api/v1/tags/list',
        'create_tag' => '/api/v1/tags/create',
        'list_users' => '/api/v2/users/list',
        'retrieve_user' => '/api/v1/users/retrieve',
        'create_or_update_user' => '/api/v1/users/create_or_update',
        'find_or_create_user' => '/api/v1/users/find_or_create',
        'delete_user' => '/api/v1/users/delete',
        'remove_user_from_company' => '/api/v1/users/remove_user_from_company',
        'retrieve_vote' => '/api/v1/votes/retrieve',
        'list_votes' => '/api/v2/votes/list',
        'create_vote' => '/api/v1/votes/create',
        'delete_vote' => '/api/v1/votes/delete',
        'enqueue_feedback' => '/api/v1/ai/enqueue',
    ];

    /**
     * @param  string  $apiKey  Canny secret API key.
     * @param  string  $baseUrl  Canny API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether credentials are available.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Return the documented Canny operation map.
     *
     * @return array<string, string>
     */
    public static function operations(): array
    {
        return self::OPERATIONS;
    }

    /**
     * Call a documented Canny operation.
     *
     * @param  string  $operation  Operation key from operations().
     * @param  array<string, mixed>  $payload  Request body fields without apiKey.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $payload = []): array
    {
        $path = self::OPERATIONS[$operation] ?? null;
        if ($path === null) {
            throw new RuntimeException("Unsupported Canny operation: {$operation}");
        }

        return $this->post($path, $payload);
    }

    /**
     * Execute a guarded raw Canny POST call against a relative API path.
     *
     * @param  string  $path  Relative Canny API path.
     * @param  array<string, mixed>  $payload  Request body fields without apiKey.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->post($this->normalizePath($path), $payload);
    }

    /**
     * POST to Canny with the configured apiKey.
     *
     * @param  array<string, mixed>  $payload  Request body fields without apiKey.
     * @return array<string, mixed>
     */
    private function post(string $path, array $payload = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Canny API key is required.');
        }

        $response = $this->rawPost($path, ['apiKey' => $this->apiKey, ...$payload]);
        if (!$response->successful()) {
            $this->throwApiError($path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw JSON POST request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     */
    private function rawPost(string $path, array $payload): Response
    {
        $url = $this->baseUrl.$path;

        try {
            return Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($url, $payload);
        } catch (\Throwable $e) {
            Log::error("Canny API connection error: POST {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Canny API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Canny API error.
     */
    private function throwApiError(string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['message'] ?? $json['error'] ?? '') : '';
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("Canny API error: POST {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Canny API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode a JSON or text Canny response.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        if ($body === '') {
            return ['success' => true];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['value' => $body];
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Canny API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
