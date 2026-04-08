<?php

namespace OpenCompany\Integrations\Coda\Tools;

use OpenCompany\Integrations\Coda\CodaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to update cells in an existing row in a Coda table.
 */
class CodaUpdateRow implements Tool
{
    /**
     * Create a new CodaUpdateRow tool instance.
     *
     * @param  CodaService  $service  The Coda API service.
     */
    public function __construct(
        private CodaService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'coda_update_row';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Update cells in an existing row in a Coda table. Provide a cells array with column/value pairs to update.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'doc_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the doc.'],
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or name of the table.'],
            'row_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the row to update.'],
            'cells' => ['type' => 'array', 'required' => true, 'description' => 'Array of cell objects to update, e.g. [{"column": "col-name-or-id", "value": "new-value"}].'],
        ];
    }

    /**
     * Execute the tool: update a row via the Coda API.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing the request ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Coda integration is not configured.');
            }

            if (empty($args['cells'])) {
                return ToolResult::error('At least one cell is required to update.');
            }

            $result = $this->service->updateRow($args['doc_id'], $args['table_id'], $args['row_id'], $args['cells']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
