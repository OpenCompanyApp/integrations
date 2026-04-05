<?php

namespace OpenCompany\Integrations\Twitch\Tools;

use OpenCompany\Integrations\Twitch\TwitchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about a specific Twitch game/category by ID.
 *
 * Wraps the Twitch Helix GET /games endpoint with an ID filter.
 */
class TwitchGetGame implements Tool
{
    public function __construct(
        private TwitchService $service,
    ) {}

    public function name(): string
    {
        return 'twitch_get_game';
    }

    public function description(): string
    {
        return 'Get information about a specific Twitch game/category by its ID. Returns game name, box art URL, and IGDB ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The game/category ID (e.g., "21779" for League of Legends).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitch integration is not configured.');
            }

            $result = $this->service->getGame($args['id']);

            $games = $result['data'] ?? [];

            if (empty($games)) {
                return ToolResult::success([
                    'game' => null,
                    'message' => 'No game found with the given ID.',
                ]);
            }

            $game = $games[0];

            return ToolResult::success([
                'game' => [
                    'id' => $game['id'] ?? null,
                    'name' => $game['name'] ?? null,
                    'box_art_url' => $game['box_art_url'] ?? null,
                    'igdb_id' => $game['igdb_id'] ?? null,
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
