<?php

namespace OpenCompany\Integrations\Notion2\Tools;

use OpenCompany\Integrations\Notion2\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NotionQueryDatabase implements Tool
{
    public function __construct(private NotionService $service) {}

    public function name(): string { return 'notion2_query_database'; }
    public function description(): string { return 'Query a Notion database with optional filters.'; }

    public function parameters(): array
    {
        return [
            'database_id'  => ['type' => 'string',  'required' => true,  'description' => 'The ID of the Notion database to query (UUID).'],
            'filter'       => ['type' => 'object',  'description' => 'Filter object to narrow results.'],
            'sorts'        => ['type' => 'array',   'description' => 'Array of sort objects.'],
            'start_cursor' => ['type' => 'string',  'description' => 'Cursor for pagination from a previous response.'],
            'page_size'    => ['type' => 'integer', 'description' => 'Number of results per page (1–100, default 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) { return ToolResult::error('Notion integration is not configured.'); }
            $databaseId = $args['database_id'] ?? '';
            if (empty($databaseId)) { return ToolResult::error('database_id is required.'); }
            $params = [];
            if (isset($args['filter'])) { $params['filter'] = $args['filter']; }
            if (isset($args['sorts'])) { $params['sorts'] = $args['sorts']; }
            if (isset($args['start_cursor'])) { $params['start_cursor'] = $args['start_cursor']; }
            if (isset($args['page_size'])) { $params['page_size'] = (int) $args['page_size']; }
            $results = $this->service->queryDatabase($databaseId, $params);
            return ToolResult::success($results);
        } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); }
    }
}
