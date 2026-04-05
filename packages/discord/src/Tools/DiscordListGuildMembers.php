<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List members of a Discord guild.
 *
 * Supports pagination via the after parameter and a limit parameter.
 */
class DiscordListGuildMembers implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_list_guild_members';
    }

    public function description(): string
    {
        return 'List members of a Discord guild. Supports pagination with limit and after.';
    }

    public function parameters(): array
    {
        return [
            'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the guild to list members for.'],
            'limit'    => ['type' => 'integer', 'description' => 'Number of members to retrieve (1–1000, default 1).'],
            'after'    => ['type' => 'string', 'description' => 'Member ID to get members after (for pagination).'],
        ];
    }

    /**
     * List members of a guild.
     *
     * @param  array<string, mixed>  $args  Tool arguments (guild_id, limit, after)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Discord integration is not configured.');
            }

            $guildId = $args['guild_id'] ?? '';

            if (empty($guildId)) {
                return ToolResult::error('guild_id is required.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['after'])) {
                $params['after'] = $args['after'];
            }

            $result = $this->service->listGuildMembers($guildId, $params);

            return ToolResult::success([
                'ok' => true,
                'members' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
