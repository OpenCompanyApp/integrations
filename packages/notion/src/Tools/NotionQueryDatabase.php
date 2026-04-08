<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Query a Notion database to retrieve rows with filtering and sorting.
 */
class NotionQueryDatabase implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_query_database';
    }

    public function description(): string
    {
        return <<<'MD'
        Query a Notion database to retrieve rows (pages). Supports filtering and sorting.
        Filter and sorts can be provided as JSON strings or arrays.
        Example filter: {"property": "Status", "select": {"equals": "Done"}}
        Example sorts: [{"property": "Name", "direction": "ascending"}]
        MD;
    }

    public function parameters(): array
    {
        return [
            'database_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the database to query.'],
            'filter' => ['type' => 'string', 'description' => 'Filter condition as a JSON string or object.'],
            'sorts' => ['type' => 'string', 'description' => 'Sort rules as a JSON array string or array.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (max 100, default 100).'],
            'start_cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * Query a database for rows matching optional filters and sorts.
     *
     * @param  array<string, mixed>  $args  Tool arguments (database_id, filter, sorts, page_size, start_cursor)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
            }

            $databaseId = $args['database_id'] ?? '';

            if (empty($databaseId)) {
                return ToolResult::error('database_id is required.');
            }

            $body = [];

            if (isset($args['filter'])) {
                $filter = $args['filter'];
                if (is_string($filter)) {
                    $decoded = json_decode($filter, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return ToolResult::error('Invalid JSON in filter: ' . json_last_error_msg());
                    }
                    $filter = $decoded;
                }
                $body['filter'] = $filter;
            }

            if (isset($args['sorts'])) {
                $sorts = $args['sorts'];
                if (is_string($sorts)) {
                    $decoded = json_decode($sorts, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        return ToolResult::error('Invalid JSON in sorts: ' . json_last_error_msg());
                    }
                    $sorts = $decoded;
                }
                $body['sorts'] = $sorts;
            }

            if (isset($args['page_size'])) {
                $body['page_size'] = min((int) $args['page_size'], 100);
            }

            if (isset($args['start_cursor'])) {
                $body['start_cursor'] = $args['start_cursor'];
            }

            $result = $this->service->queryDatabase($databaseId, $body);
            $results = $result['results'] ?? [];

            $output = [];
            foreach ($results as $page) {
                $output[] = [
                    'id' => $page['id'] ?? '',
                    'properties' => $page['properties'] ?? [],
                    'url' => $page['url'] ?? '',
                    'created_time' => $page['created_time'] ?? null,
                    'last_edited_time' => $page['last_edited_time'] ?? null,
                ];
            }

            $response = ['count' => count($output), 'results' => $output];

            if (isset($result['has_more']) && $result['has_more']) {
                $response['has_more'] = true;
                $response['next_cursor'] = $result['next_cursor'] ?? null;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
