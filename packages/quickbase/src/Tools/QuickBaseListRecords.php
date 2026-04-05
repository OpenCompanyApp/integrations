<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

use OpenCompany\Integrations\QuickBase\QuickBaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QuickBaseListRecords implements Tool
{
    public function __construct(
        private QuickBaseService $service,
    ) {}

    public function name(): string
    {
        return 'quickbase_list_records';
    }

    public function description(): string
    {
        return 'Query records from a QuickBase table. Supports filtering by conditions, selecting specific fields, sorting, grouping, and pagination. Use the where clause to filter records (QuickBase query syntax).';
    }

    public function parameters(): array
    {
        return [
            'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID (dbid) to query records from.'],
            'where' => ['type' => 'string', 'description' => 'Filter expression in QuickBase query syntax, e.g. \'{3.EX.\'Complete\'}\'. Omit to return all records.'],
            'select' => ['type' => 'array', 'description' => 'Array of field IDs to include in the response. Omit to return all fields.'],
            'sortBy' => ['type' => 'array', 'description' => 'Sort specification: [{fieldId: 3, order: "ASC"}, ...].'],
            'groupBy' => ['type' => 'array', 'description' => 'Grouping specification: [{fieldId: 3, grouping: "equal-values"}, ...].'],
            'options' => ['type' => 'object', 'description' => 'Additional query options: {skip: 0, top: 100, compareWith: "yesterday", includeRids: true}.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('QuickBase integration is not configured.');
            }

            $tableId = $args['tableId'] ?? '';
            if (empty($tableId)) {
                return ToolResult::error('The tableId parameter is required.');
            }

            $options = [];

            if (isset($args['where'])) {
                $options['where'] = $args['where'];
            }

            if (isset($args['select'])) {
                $options['select'] = $args['select'];
            }

            if (isset($args['sortBy'])) {
                $options['sortBy'] = $args['sortBy'];
            }

            if (isset($args['groupBy'])) {
                $options['groupBy'] = $args['groupBy'];
            }

            if (isset($args['options'])) {
                $options['options'] = $args['options'];
            }

            $result = $this->service->queryRecords($tableId, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
