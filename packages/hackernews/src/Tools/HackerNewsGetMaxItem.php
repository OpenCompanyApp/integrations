<?php

namespace OpenCompany\Integrations\HackerNews\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HackerNews\HackerNewsService;

/**
 * Fetch the current largest Hacker News item id.
 */
class HackerNewsGetMaxItem implements Tool
{
    /**
     * @param  HackerNewsService  $service  The HN API service instance.
     */
    public function __construct(
        private HackerNewsService $service,
    ) {}

    public function name(): string
    {
        return 'hackernews_get_max_item';
    }

    public function description(): string
    {
        return 'Fetch the current largest Hacker News item ID. Useful for walking backward through all public HN items.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the max HN item id.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $maxItem = $this->service->maxItem();

            if ($maxItem === null) {
                return ToolResult::error('Failed to fetch the current max item ID from Hacker News.');
            }

            return ToolResult::success([
                'max_item' => $maxItem,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
