<?php

namespace OpenCompany\Integrations\Twitter\Tools;

use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve the authenticated user's Twitter profile.
 *
 * Calls `GET /users/me` on the Twitter API v2.
 */
class TwitterGetCurrentUser implements Tool
{
    public function __construct(
        private TwitterService $service,
    ) {}

    public function name(): string
    {
        return 'twitter_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Twitter user\'s profile information, including ID, name, and username.';
    }

    public function parameters(): array
    {
        return [
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
            $result = $this->service->getCurrentUser($userFields);

            if (!isset($result['data'])) {
                return ToolResult::error('Unable to retrieve current user profile.');
            }

            return ToolResult::success($result['data']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
