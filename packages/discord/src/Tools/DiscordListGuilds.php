<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List guilds the current user is in.
 *
 * Returns guild IDs, names, icons, and owner status.
 */
class DiscordListGuilds implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_list_guilds';
    }

    public function description(): string
    {
        return <<<'MD'
        List guilds the current Discord user is a member of.
        Returns guild IDs, names, icons, and owner status.
        Use limit, before, and after for pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit'  => ['type' => 'integer', 'description' => 'Number of guilds to retrieve (1–200, default 200).'],
            'before' => ['type' => 'string', 'description' => 'Guild ID to get guilds before (for pagination).'],
            'after'  => ['type' => 'string', 'description' => 'Guild ID to get guilds after (for pagination).'],
        ];
    }

    /**
     * List guilds the current user is in.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, before, after)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Discord integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['before'])) {
                $params['before'] = $args['before'];
            }
            if (isset($args['after'])) {
                $params['after'] = $args['after'];
            }

            $result = $this->service->listGuilds($params);

            $guilds = array_map(function (array $guild): array {
                return [
                    'id' => $guild['id'] ?? '',
                    'name' => $guild['name'] ?? '',
                    'icon' => $guild['icon'] ?? null,
                    'owner' => $guild['owner'] ?? false,
                ];
            }, $result);

            return ToolResult::success([
                'results' => $guilds,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
