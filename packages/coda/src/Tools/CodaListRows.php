<?php

namespace OpenCompany\Integrations\Coda\Tools;

use OpenCompany\Integrations\Coda\CodaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list rows in a Coda table.
 *
 * Supports pagination, sorting, and returning values keyed by column names
 * instead of column IDs for easier consumption.
 */
class CodaListRows implements Tool
{
    /**
     * Create a new CodaListRows tool instance.
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
        return 'coda_list_rows';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'List rows in a Coda table. Use useColumnNames=true to get values keyed by human-readable column names instead of column IDs.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'doc_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the doc.'],
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or name of the table.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of rows to return (default: 20, max: 1000).'],
            'useColumnNames' => ['type' => 'boolean', 'description' => 'If true, return values keyed by column names instead of column IDs (default: true).'],
        ];
    }

    /**
     * Execute the tool: list rows from the Coda API.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing the list of rows.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Coda integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['useColumnNames'])) {
                $params['useColumnNames'] = $args['useColumnNames'] ? 'true' : 'false';
            } else {
                $params['useColumnNames'] = 'true';
            }

            $result = $this->service->listRows($args['doc_id'], $args['table_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
