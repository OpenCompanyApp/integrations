<?php

namespace OpenCompany\Integrations\Metabase\Tools;

use OpenCompany\Integrations\Metabase\MetabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MetabaseQueryCard implements Tool
{
    public function __construct(
        private MetabaseService $service,
    ) {}

    public function name(): string
    {
        return 'metabase_query_card';
    }

    public function description(): string
    {
        return 'Execute a saved Metabase card (question) and return the query results as rows. Use metabase_list_cards or metabase_get_card to find card IDs. The card must be a question (not a model or metric).';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The card (question) ID to execute.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Metabase integration is not configured.');
            }

            $result = $this->service->queryCard((int) $args['id']);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Metabase query result into a readable structure.
     *
     * @param  array<string, mixed>  $result
     * @return array<string, mixed>
     */
    private function formatResponse(array $result): array
    {
        $rows = $result['data']['rows'] ?? [];
        $cols = $result['data']['cols'] ?? [];

        $columnNames = array_map(fn (array $col) => $col['name'] ?? ($col['display_name'] ?? 'unknown'), $cols);

        $formattedRows = array_map(function (array $row) use ($columnNames) {
            return array_combine($columnNames, $row) ?: $row;
        }, $rows);

        return [
            'rows' => $formattedRows,
            'rowCount' => count($formattedRows),
            'columns' => $columnNames,
        ];
    }
}
