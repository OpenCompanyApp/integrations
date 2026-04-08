<?php

namespace OpenCompany\Integrations\Coda\Tools;

use OpenCompany\Integrations\Coda\CodaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to delete a row from a Coda table.
 */
class CodaDeleteRow implements Tool
{
    /**
     * Create a new CodaDeleteRow tool instance.
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
        return 'coda_delete_row';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Delete a row from a Coda table. This action is permanent.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'doc_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the doc.'],
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or name of the table.'],
            'row_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the row to delete.'],
        ];
    }

    /**
     * Execute the tool: delete a row via the Coda API.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result confirming deletion.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Coda integration is not configured.');
            }

            $this->service->deleteRow($args['doc_id'], $args['table_id'], $args['row_id']);

            return ToolResult::success("Row '{$args['row_id']}' has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
