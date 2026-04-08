<?php

namespace OpenCompany\Integrations\Twitch\Tools;

use OpenCompany\Integrations\Twitch\TwitchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about one or more Twitch users.
 *
 * Wraps the Twitch Helix GET /users endpoint.
 */
class TwitchGetUser implements Tool
{
    public function __construct(
        private TwitchService $service,
    ) {}

    public function name(): string
    {
        return 'twitch_get_user';
    }

    public function description(): string
    {
        return 'Get information about a Twitch user by user ID or login name. Returns display name, bio, profile image, and account details.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'description' => 'The user ID to look up.'],
            'login' => ['type' => 'string', 'description' => 'The login name to look up (e.g., "ninja").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitch integration is not configured.');
            }

            $id = $args['id'] ?? null;
            $login = $args['login'] ?? null;

            if ($id === null && $login === null) {
                return ToolResult::error('Either id or login is required.');
            }

            $result = $this->service->getUser($id, $login);

            $users = $result['data'] ?? [];

            if (empty($users)) {
                return ToolResult::success([
                    'users' => [],
                    'message' => 'No user found matching the given criteria.',
                ]);
            }

            $formatted = array_map(function (array $user): array {
                return [
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
                ];
            }, $users);

            return ToolResult::success([
                'users' => $formatted,
                'count' => count($formatted),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
