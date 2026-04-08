<?php

namespace OpenCompany\Integrations\Kintone\Tools;

use OpenCompany\Integrations\Kintone\KintoneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KintoneListRecords implements Tool
{
    public function __construct(
        private KintoneService $service,
    ) {}

    public function name(): string
    {
        return 'kintone_list_records';
    }

    public function description(): string
    {
        return 'Retrieve records from a Kintone app. Supports filtering with a query string, selecting specific fields, and pagination with limit/offset. Use this to search and list data stored in any Kintone app.';
    }

    public function parameters(): array
    {
        return [
            'app' => ['type' => 'integer', 'required' => true, 'description' => 'The app ID.'],
            'query' => ['type' => 'string', 'description' => 'Kintone query string to filter records (e.g., "Status = \"Open\" order by Record_number asc").'],
            'fields' => ['type' => 'array', 'description' => 'List of field codes to include in the response. Omit to return all fields.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of records to return (max 500, default 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of records to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kintone integration is not configured.');
            }

            $result = $this->service->listRecords(
                app: (int) $args['app'],
                query: $args['query'] ?? null,
                fields: $args['fields'] ?? null,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                offset: isset($args['offset']) ? (int) $args['offset'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
