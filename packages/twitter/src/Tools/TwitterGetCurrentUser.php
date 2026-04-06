<?php

namespace OpenCompany\Integrations\Twitter\Tools;

use OpenCompany\Integrations\Twitter\TwitterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the currently authenticated user's profile.
 *
 * Calls the Twitter API v2 `GET /2/users/me` endpoint to retrieve
 * the profile information of the user associated with the Bearer token.
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
        return 'Get the authenticated user\'s Twitter profile. Returns the user ID, name, and username associated with the configured access token.';
    }

    public function parameters(): array
    {
        return [
            'tweet_fields' => ['type' => 'array', 'description' => 'Tweet fields to include in the response (e.g. created_at, public_metrics).'],
            'user_fields' => ['type' => 'array', 'description' => 'Additional user fields to include (e.g. created_at, description, public_metrics, profile_image_url, verified, url).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitter integration is not configured.');
            }

            $tweetFields = $args['tweet_fields'] ?? [];
            $userFields = $args['user_fields'] ?? [];

            $result = $this->service->getCurrentUser($tweetFields, $userFields);

            $user = $result['data'] ?? null;
            if (!$user) {
                return ToolResult::error('Could not retrieve current user. The access token may be invalid.');
            }

            $response = [
                'id' => $user['id'] ?? null,
                'name' => $user['name'] ?? null,
                'username' => $user['username'] ?? null,
            ] + array_diff_key($user, ['id' => null, 'name' => null, 'username' => null]);

            if (isset($result['includes'])) {
                $response['includes'] = $result['includes'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
