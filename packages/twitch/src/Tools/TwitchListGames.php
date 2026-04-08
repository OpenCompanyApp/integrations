<?php

namespace OpenCompany\Integrations\Twitch\Tools;

use OpenCompany\Integrations\Twitch\TwitchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about one or more Twitch games/categories.
 *
 * Wraps the Twitch Helix GET /games endpoint.
 */
class TwitchListGames implements Tool
{
    public function __construct(
        private TwitchService $service,
    ) {}

    public function name(): string
    {
        return 'twitch_list_games';
    }

    public function description(): string
    {
        return 'Get information about Twitch games/categories by ID or name. Returns game name, box art URL, and IGDB ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'description' => 'Game ID to look up.'],
            'name' => ['type' => 'string', 'description' => 'Game name to look up (e.g., "Fortnite").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitch integration is not configured.');
            }

            $id = $args['id'] ?? null;
            $name = $args['name'] ?? null;

            if ($id === null && $name === null) {
                return ToolResult::error('Either id or name is required.');
            }

            $result = $this->service->listGames($id, $name);

            $games = $result['data'] ?? [];

            if (empty($games)) {
                return ToolResult::success([
                    'games' => [],
                    'message' => 'No games found matching the given criteria.',
                ]);
            }

            $formatted = array_map(function (array $game): array {
                return [
                    'id' => $game['id'] ?? null,
                    'name' => $game['name'] ?? null,
                    'box_art_url' => $game['box_art_url'] ?? null,
                    'igdb_id' => $game['igdb_id'] ?? null,
                ];
            }, $games);

            return ToolResult::success([
                'games' => $formatted,
                'count' => count($formatted),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
