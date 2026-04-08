<?php

namespace OpenCompany\Integrations\Metabase\Tools;

use OpenCompany\Integrations\Metabase\MetabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MetabaseListCards implements Tool
{
    public function __construct(
        private MetabaseService $service,
    ) {}

    public function name(): string
    {
        return 'metabase_list_cards';
    }

    public function description(): string
    {
        return 'List all cards (questions/saved questions) in Metabase. Returns card IDs, names, collection info, and display types. Use metabase_get_card for full definitions or metabase_query_card to run a card.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Metabase integration is not configured.');
            }

            $cards = $this->service->listCards();

            return ToolResult::success([
                'cards' => $cards,
                'count' => count($cards),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
