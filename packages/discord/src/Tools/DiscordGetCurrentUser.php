<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the currently authenticated Discord user.
 *
 * Returns the user's ID, username, discriminator, and avatar.
 */
class DiscordGetCurrentUser implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve the currently authenticated Discord user.
        Returns the user's ID, username, discriminator, and avatar.
        Useful for identifying which account or token is in use.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the currently authenticated Discord user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Discord integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'username' => $result['username'] ?? '',
                'discriminator' => $result['discriminator'] ?? '',
                'avatar' => $result['avatar'] ?? null,
                'global_name' => $result['global_name'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
