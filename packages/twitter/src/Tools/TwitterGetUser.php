<?php

namespace OpenCompany\Integrations\Twitter\Tools;

use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single user's profile by ID.
 *
 * Fetches a user using the Twitter API v2 `GET /2/users/:id` endpoint.
 * Supports requesting additional user fields such as metrics and description.
 */
class TwitterGetUser implements Tool
{
    public function __construct(
        private TwitterService $service,
    ) {}

    public function name(): string
    {
        return 'twitter_get_user';
    }

    public function description(): string
    {
        return 'Get a Twitter user\'s profile by their user ID. Returns name, username, and any requested additional fields (e.g. created_at, public_metrics, profile_image_url, description).';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The user ID to retrieve.'],
            'user_fields' => ['type' => 'array', 'description' => 'Additional user fields to include (e.g. created_at, description, public_metrics, profile_image_url, verified, url).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured.');
            }

            $id = $args['id'];
            $userFields = $args['user_fields'] ?? [];

            $result = $this->service->getUser($id, $userFields);

            $user = $result['data'] ?? null;
            if (!$user) {
                return ToolResult::error("User with ID '{$id}' not found.");
            }

            $response = [
                'id' => $user['id'] ?? null,
                'name' => $user['name'] ?? null,
                'username' => $user['username'] ?? null,
            ] + array_diff_key($user, ['id' => null, 'name' => null, 'username' => null]);

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
