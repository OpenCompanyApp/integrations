<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Discord user by their ID.
 */
class DiscordGetUser implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_get_user';
    }

    public function description(): string
    {
        return 'Get information about a Discord user by their ID.';
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the user to retrieve.'],
        ];
    }

    /**
     * Get user information by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Discord integration is not configured.');
            }

            $userId = $args['user_id'] ?? '';

            if (empty($userId)) {
                return ToolResult::error('user_id is required.');
            }

            $result = $this->service->getUser($userId);

            return ToolResult::success([
                'ok' => true,
                'user' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
