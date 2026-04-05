<?php

namespace OpenCompany\Integrations\Twitch\Tools;

use OpenCompany\Integrations\Twitch\TwitchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated Twitch user's information.
 *
 * Wraps the Twitch Helix GET /users endpoint (no parameters = authenticated user).
 */
class TwitchGetCurrentUser implements Tool
{
    public function __construct(
        private TwitchService $service,
    ) {}

    public function name(): string
    {
        return 'twitch_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Twitch user. Returns display name, bio, profile image, and account type.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitch integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $users = $result['data'] ?? [];

            if (empty($users)) {
                return ToolResult::error('Could not retrieve current user information. The access token may be invalid.');
            }

            $user = $users[0];

            return ToolResult::success([
                'user' => [
                    'id' => $user['id'] ?? null,
                    'login' => $user['login'] ?? null,
                    'display_name' => $user['display_name'] ?? null,
                    'type' => $user['type'] ?? null,
                    'broadcaster_type' => $user['broadcaster_type'] ?? null,
                    'description' => $user['description'] ?? null,
                    'profile_image_url' => $user['profile_image_url'] ?? null,
                    'offline_image_url' => $user['offline_image_url'] ?? null,
                    'view_count' => $user['view_count'] ?? 0,
                    'email' => $user['email'] ?? null,
                    'created_at' => $user['created_at'] ?? null,
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
