<?php

namespace OpenCompany\Integrations\Grist\Tools;

use OpenCompany\Integrations\Grist\GristService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new column in a Grist table.
 *
 * Supports all Grist column types including formula columns.
 */
class GristCreateColumn implements Tool
{
    /**
     * @param  GristService  $service  The Grist API client
     */
    public function __construct(
        private GristService $service,
    ) {}

    public function name(): string
    {
        return 'grist_create_column';
    }

    public function description(): string
    {
        return 'Create a new column in a Grist table.';
    }

    public function parameters(): array
    {
        return [
            'doc_id'   => ['type' => 'string', 'required' => true, 'description' => 'Grist document ID.'],
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'Grist table ID.'],
            'col_id'   => ['type' => 'string', 'required' => true, 'description' => 'Column identifier (used as the field key, e.g., "FirstName").'],
            'label'    => ['type' => 'string', 'required' => true, 'description' => 'Human-readable column label.'],
            'type'     => ['type' => 'string', 'required' => true, 'description' => 'Grist column type (e.g., "Text", "Int", "Numeric", "Bool", "Date", "Choice", "Ref", "Any").'],
            'formula'  => ['type' => 'string', 'description' => 'Optional formula for a formula column (e.g., "$A + $B").'],
        ];
    }

    /**
     * Create a new column in the specified table.
     *
     * @param  array<string, mixed>  $args  Tool arguments (doc_id, table_id, col_id, label, type, formula)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Grist integration is not configured.');
            }

            $docId = $args['doc_id'] ?? '';
            $tableId = $args['table_id'] ?? '';
            $colId = $args['col_id'] ?? '';
            $label = $args['label'] ?? '';
            $type = $args['type'] ?? '';
            $formula = $args['formula'] ?? '';

            if (empty($docId)) {
                return ToolResult::error('doc_id is required.');
            }
            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }
            if (empty($colId)) {
                return ToolResult::error('col_id is required.');
            }
            if (empty($label)) {
                return ToolResult::error('label is required.');
            }
            if (empty($type)) {
                return ToolResult::error('type is required.');
            }

            $result = $this->service->createColumn($docId, $tableId, $colId, $label, $type, $formula);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
