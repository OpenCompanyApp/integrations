<?php

namespace OpenCompany\Integrations\Twitter\Tools;

use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list followers of a user with pagination.
 *
 * Retrieves follower data using the Twitter API v2 `GET /2/users/:id/followers`
 * endpoint. Supports pagination via `max_results` and `pagination_token`.
 */
class TwitterListUsers implements Tool
{
    public function __construct(
        private TwitterService $service,
    ) {}

    public function name(): string
    {
        return 'twitter_list_users';
    }

    public function description(): string
    {
        return 'List followers of a Twitter user by their user ID. Returns user profiles with pagination support. Use max_results to control page size and page token for next pages.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The user ID whose followers to list.'],
            'max_results' => ['type' => 'integer', 'description' => 'Number of users to return per page (1–1000, default: 100).'],
            'page' => ['type' => 'string', 'description' => 'Pagination token from a previous response to get the next page of results.'],
            'user_fields' => ['type' => 'array', 'description' => 'Additional user fields to include (e.g. created_at, public_metrics, profile_image_url, description).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured.');
            }

            $id = $args['id'];
            $maxResults = isset($args['max_results']) ? (int) $args['max_results'] : 100;
            $paginationToken = $args['page'] ?? null;
            $userFields = $args['user_fields'] ?? [];

            $result = $this->service->listUsers($id, $maxResults, $paginationToken, $userFields);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Twitter API response into a clean result.
     *
     * @param  array<string, mixed>  $result
     * @return array<string, mixed>
     */
    private function formatResponse(array $result): array
    {
        $users = $result['data'] ?? [];
        $meta = $result['meta'] ?? [];

        $response = [
            'users' => array_map(function (array $user) {
                return [
                    'id' => $user['id'] ?? null,
                    'name' => $user['name'] ?? null,
                    'username' => $user['username'] ?? null,
                ] + array_diff_key($user, ['id' => null, 'name' => null, 'username' => null]);
            }, $users),
            'count' => count($users),
        ];

        if (isset($meta['next_token'])) {
            $response['next_page'] = $meta['next_token'];
        }

        if (isset($meta['result_count'])) {
            $response['total_results'] = $meta['result_count'];
        }

        return $response;
    }
}
