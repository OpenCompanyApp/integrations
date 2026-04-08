<?php

namespace OpenCompany\Integrations\Metabase\Tools;

use OpenCompany\Integrations\Metabase\MetabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MetabaseGetCard implements Tool
{
    public function __construct(
        private MetabaseService $service,
    ) {}

    public function name(): string
    {
        return 'metabase_get_card';
    }

    public function description(): string
    {
        return 'Get the full definition of a Metabase card (question) by ID, including the query, display settings, and parameters. Use metabase_list_cards to find card IDs.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The card (question) ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Metabase integration is not configured.');
            }

            $card = $this->service->getCard((int) $args['id']);

            return ToolResult::success($card);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
