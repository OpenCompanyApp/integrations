<?php

namespace OpenCompany\Integrations\Coda\Tools;

use OpenCompany\Integrations\Coda\CodaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single row from a Coda table by its ID.
 */
class CodaGetRow implements Tool
{
    /**
     * Create a new CodaGetRow tool instance.
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
        return 'coda_get_row';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Get a single row from a Coda table by its row ID.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'doc_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the doc.'],
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or name of the table.'],
            'row_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the row to retrieve.'],
            'useColumnNames' => ['type' => 'boolean', 'description' => 'If true, return values keyed by column names instead of column IDs (default: true).'],
        ];
    }

    /**
     * Execute the tool: get a row from the Coda API.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing the row details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Coda integration is not configured.');
            }

            $params = [];
            if (isset($args['useColumnNames'])) {
                $params['useColumnNames'] = $args['useColumnNames'] ? 'true' : 'false';
            } else {
                $params['useColumnNames'] = 'true';
            }

            $result = $this->service->getRow($args['doc_id'], $args['table_id'], $args['row_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
