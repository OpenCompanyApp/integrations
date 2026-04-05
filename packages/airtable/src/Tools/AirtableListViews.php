<?php

namespace OpenCompany\Integrations\Airtable\Tools;

use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List views for an Airtable base.
 */
class AirtableListViews implements Tool
{
    /**
     * @param  AirtableService  $service  The Airtable API client
     */
    public function __construct(
        private AirtableService $service,
    ) {}

    public function name(): string
    {
        return 'airtable_list_views';
    }

    public function description(): string
    {
        return 'List views for an Airtable base.';
    }

    public function parameters(): array
    {
        return [
            'base_id' => ['type' => 'string', 'required' => true, 'description' => 'Airtable base ID (e.g., "appXXXXXXXXXXXX").'],
        ];
    }

    /**
     * List all views in a base.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Airtable integration is not configured.');
            }

            $baseId = $args['base_id'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }

            $result = $this->service->listViews($baseId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
