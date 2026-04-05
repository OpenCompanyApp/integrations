<?php

namespace OpenCompany\Integrations\Twitch\Tools;

use OpenCompany\Integrations\Twitch\TwitchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search for games/categories on Twitch.
 *
 * Wraps the Twitch Helix GET /search/categories endpoint.
 */
class TwitchSearchCategories implements Tool
{
    public function __construct(
        private TwitchService $service,
    ) {}

    public function name(): string
    {
        return 'twitch_search_categories';
    }

    public function description(): string
    {
        return 'Search for games/categories on Twitch by name. Returns matching categories with IDs you can use to filter streams.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query (e.g., "League of Legends", "Just Chatting").'],
            'first' => ['type' => 'integer', 'description' => 'Number of results to return (max 100, default 20).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Twitch integration is not configured.');
            }

            $first = isset($args['first']) ? min((int) $args['first'], 100) : 20;
            $after = $args['after'] ?? null;

            $result = $this->service->searchCategories($args['query'], $first, $after);

            $categories = $result['data'] ?? [];
            $formatted = array_map(function (array $category): array {
                return [
                    'id' => $category['id'] ?? null,
                    'name' => $category['name'] ?? null,
                    'box_art_url' => $category['box_art_url'] ?? null,
                    'igdb_id' => $category['igdb_id'] ?? null,
                ];
            }, $categories);

            return ToolResult::success([
                'categories' => $formatted,
                'count' => count($formatted),
                'pagination' => $result['pagination'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
