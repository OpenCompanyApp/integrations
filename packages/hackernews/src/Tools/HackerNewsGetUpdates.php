<?php

namespace OpenCompany\Integrations\HackerNews\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HackerNews\HackerNewsService;

/**
 * Fetch recently changed Hacker News item and profile identifiers.
 */
class HackerNewsGetUpdates implements Tool
{
    /**
     * @param  HackerNewsService  $service  The HN API service instance.
     */
    public function __construct(
        private HackerNewsService $service,
    ) {}

    public function name(): string
    {
        return 'hackernews_get_updates';
    }

    public function description(): string
    {
        return 'Fetch recently changed Hacker News item IDs and user profile IDs from the official updates endpoint.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch changed item and profile identifiers.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $updates = $this->service->updates();

            if ($updates === null) {
                return ToolResult::error('Failed to fetch changed Hacker News items and profiles.');
            }

            $items = $updates['items'] ?? [];
            $profiles = $updates['profiles'] ?? [];

            return ToolResult::success([
                'items' => $items,
                'profiles' => $profiles,
                'item_count' => count($items),
                'profile_count' => count($profiles),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
