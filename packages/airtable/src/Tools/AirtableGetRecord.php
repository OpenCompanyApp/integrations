<?php

namespace OpenCompany\Integrations\Airtable\Tools;

use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Airtable record by its ID.
 */
class AirtableGetRecord implements Tool
{
    /**
     * @param  AirtableService  $service  The Airtable API client
     */
    public function __construct(
        private AirtableService $service,
    ) {}

    public function name(): string
    {
        return 'airtable_get_record';
    }

    public function description(): string
    {
        return 'Get a single Airtable record by ID.';
    }

    public function parameters(): array
    {
        return [
            'base_id'   => ['type' => 'string', 'required' => true, 'description' => 'Airtable base ID (e.g., "appXXXXXXXXXXXX").'],
            'table'     => ['type' => 'string', 'required' => true, 'description' => 'Table ID or name.'],
            'record_id' => ['type' => 'string', 'required' => true, 'description' => 'Record ID (e.g., "recXXXXXXXXXXXX").'],
        ];
    }

    /**
     * Get a single record by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id, table, record_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Airtable integration is not configured.');
            }

            $baseId = $args['base_id'] ?? '';
            $table = $args['table'] ?? '';
            $recordId = $args['record_id'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }
            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($recordId)) {
                return ToolResult::error('record_id is required.');
            }

            $result = $this->service->getRecord($baseId, $table, $recordId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
