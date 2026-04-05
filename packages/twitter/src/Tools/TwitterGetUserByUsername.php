<?php

namespace OpenCompany\Integrations\Twitter\Tools;

use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a Twitter user by their username (handle).
 *
 * Calls `GET /users/by/username/{username}` on the Twitter API v2.
 */
class TwitterGetUserByUsername implements Tool
{
    public function __construct(
        private TwitterService $service,
    ) {}

    public function name(): string
    {
        return 'twitter_get_user_by_username';
    }

    public function description(): string
    {
        return 'Look up a Twitter user by their username (handle). Returns the user\'s ID, name, and username.';
    }

    public function parameters(): array
    {
        return [
            'username' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Twitter username (without @, e.g., "twitterapi").',
            ],
            'user_fields' => [
                'type' => 'array',
                'description' => 'Additional user fields to include: created_at, description, entities, id, location, name, pinned_tweet_id, profile_image_url, protected, public_metrics, url, username, verified, verified_type, withheld.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured.');
            }

            $userFields = $args['user_fields'] ?? [];
            $result = $this->service->getUserByUsername($args['username'], $userFields);

            if (!isset($result['data'])) {
                return ToolResult::error("User '@{$args['username']}' not found.");
            }

            return ToolResult::success($result['data']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
