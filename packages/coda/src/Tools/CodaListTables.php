<?php

namespace OpenCompany\Integrations\Coda\Tools;

use OpenCompany\Integrations\Coda\CodaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list tables in a Coda doc.
 */
class CodaListTables implements Tool
{
    /**
     * Create a new CodaListTables tool instance.
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
        return 'coda_list_tables';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'List tables in a Coda doc. Returns table IDs, names, and display types.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'doc_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the doc.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of tables to return (default: 20, max: 100).'],
        ];
    }

    /**
     * Execute the tool: list tables from the Coda API.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The result containing the list of tables.
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

            $result = $this->service->listTables($args['doc_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
