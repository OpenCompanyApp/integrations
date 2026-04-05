<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a role to a guild member in Discord.
 */
class DiscordAddMemberRole implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_add_member_role';
    }

    public function description(): string
    {
        return 'Add a role to a guild member in Discord.';
    }

    public function parameters(): array
    {
        return [
            'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the guild.'],
            'user_id'  => ['type' => 'string', 'required' => true, 'description' => 'The ID of the user to add the role to.'],
            'role_id'  => ['type' => 'string', 'required' => true, 'description' => 'The ID of the role to add.'],
        ];
    }

    /**
     * Add a role to a guild member.
     *
     * @param  array<string, mixed>  $args  Tool arguments (guild_id, user_id, role_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Discord integration is not configured.');
            }

            $guildId = $args['guild_id'] ?? '';
            $userId = $args['user_id'] ?? '';
            $roleId = $args['role_id'] ?? '';

            if (empty($guildId)) {
                return ToolResult::error('guild_id is required.');
            }
            if (empty($userId)) {
                return ToolResult::error('user_id is required.');
            }
            if (empty($roleId)) {
                return ToolResult::error('role_id is required.');
            }

            $this->service->addMemberRole($guildId, $userId, $roleId);

            return ToolResult::success([
                'ok' => true,
                'guild_id' => $guildId,
                'user_id' => $userId,
                'role_id' => $roleId,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
