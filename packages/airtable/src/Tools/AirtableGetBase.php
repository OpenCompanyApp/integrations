<?php

namespace OpenCompany\Integrations\Airtable\Tools;

use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a single Airtable base.
 */
class AirtableGetBase implements Tool
{
    /**
     * @param  AirtableService  $service  The Airtable API client
     */
    public function __construct(
        private AirtableService $service,
    ) {}

    public function name(): string
    {
        return 'airtable_get_base';
    }

    public function description(): string
    {
        return 'Get details for a single Airtable base by ID.';
    }

    public function parameters(): array
    {
        return [
            'base_id' => ['type' => 'string', 'required' => true, 'description' => 'Airtable base ID (e.g., "appXXXXXXXXXXXX").'],
        ];
    }

    /**
     * Get a single base by ID.
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

            $result = $this->service->getBase($baseId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
