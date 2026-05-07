<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

use OpenCompany\Integrations\QuickBase\QuickBaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Quickbase record by record ID.
 */
class QuickBaseGetRecord implements Tool
{
    /**
     * @param  QuickBaseService  $service  The Quickbase REST API client.
     */
    public function __construct(
        private QuickBaseService $service,
    ) {}

    public function name(): string
    {
        return 'quickbase_get_record';
    }

    public function description(): string
    {
        return 'Get a single QuickBase record by its record ID. Returns all field values for the specified record.';
    }

    public function parameters(): array
    {
        return [
            'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID (dbid) the record belongs to.'],
            'recordId' => ['type' => 'integer', 'required' => true, 'description' => 'The record ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('QuickBase integration is not configured.');
            }

            $tableId = $args['tableId'] ?? '';
            $recordId = $args['recordId'] ?? null;

            if (empty($tableId)) {
                return ToolResult::error('The tableId parameter is required.');
            }

            if ($recordId === null) {
                return ToolResult::error('The recordId parameter is required.');
            }

            $result = $this->service->getRecord($tableId, (int) $recordId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
