<?php

namespace OpenCompany\Integrations\Grist\Tools;

use OpenCompany\Integrations\Grist\GristService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get full column data for a Grist table (raw cell values per column).
 */
class GristGetRecord implements Tool
{
    /**
     * @param  GristService  $service  The Grist API client
     */
    public function __construct(
        private GristService $service,
    ) {}

    public function name(): string
    {
        return 'grist_get_record';
    }

    public function description(): string
    {
        return 'Get full column data for a Grist table (raw cell values per column).';
    }

    public function parameters(): array
    {
        return [
            'doc_id'   => ['type' => 'string', 'required' => true, 'description' => 'Grist document ID.'],
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'Grist table ID.'],
        ];
    }

    /**
     * Get full table data (all columns with their cell values).
     *
     * @param  array<string, mixed>  $args  Tool arguments (doc_id, table_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Grist integration is not configured.');
            }

            $docId = $args['doc_id'] ?? '';
            $tableId = $args['table_id'] ?? '';

            if (empty($docId)) {
                return ToolResult::error('doc_id is required.');
            }
            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }

            $result = $this->service->getTableData($docId, $tableId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
