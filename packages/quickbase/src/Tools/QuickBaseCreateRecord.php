<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

use OpenCompany\Integrations\QuickBase\QuickBaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new record in a Quickbase table.
 */
class QuickBaseCreateRecord implements Tool
{
    /**
     * @param  QuickBaseService  $service  The Quickbase REST API client.
     */
    public function __construct(
        private QuickBaseService $service,
    ) {}

    public function name(): string
    {
        return 'quickbase_create_record';
    }

    public function description(): string
    {
        return 'Create a new record in a QuickBase table. Provide field data as an array of {fieldId, value} pairs.';
    }

    public function parameters(): array
    {
        return [
            'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID (dbid) to create the record in.'],
            'fields' => ['type' => 'array', 'required' => true, 'description' => 'Array of field data objects: [{fieldId: 6, value: "New value"}, {fieldId: 7, value: 42}, ...]. Each object must have a fieldId (integer) and value (mixed).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('QuickBase integration is not configured.');
            }

            $tableId = $args['tableId'] ?? '';
            $fields = $args['fields'] ?? [];

            if (empty($tableId)) {
                return ToolResult::error('The tableId parameter is required.');
            }

            if (empty($fields)) {
                return ToolResult::error('The fields parameter is required. Provide at least one field to set.');
            }

            $result = $this->service->createRecord($tableId, $fields);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
