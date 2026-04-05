<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all databases accessible to the integration using the search endpoint.
 */
class NotionListDatabases implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_list_databases';
    }

    public function description(): string
    {
        return <<<'MD'
        List all databases accessible to the integration. Uses the search endpoint
        filtered to database objects. Optionally provide a query to filter by name.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Search query to filter database names.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (max 100, default 10).'],
            'start_cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * List databases accessible to the integration, optionally filtered by name.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, page_size, start_cursor)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
            }

            $body = [
                'filter' => ['value' => 'database', 'property' => 'object'],
            ];

            if (isset($args['query'])) {
                $body['query'] = $args['query'];
            }

            if (isset($args['page_size'])) {
                $body['page_size'] = min((int) $args['page_size'], 100);
            }

            if (isset($args['start_cursor'])) {
                $body['start_cursor'] = $args['start_cursor'];
            }

            $result = $this->service->search($body);
            $results = $result['results'] ?? [];

            if (empty($results)) {
                return ToolResult::success('No databases found.');
            }

            $output = [];
            foreach ($results as $db) {
                $titleArr = $db['title'] ?? [];
                $title = is_array($titleArr)
                    ? implode('', array_map(fn (array $t) => $t['plain_text'] ?? '', $titleArr))
                    : 'Untitled';

                $output[] = [
                    'id' => $db['id'] ?? '',
                    'title' => $title,
                    'url' => $db['url'] ?? '',
                    'last_edited_time' => $db['last_edited_time'] ?? null,
                ];
            }

            $response = ['count' => count($output), 'databases' => $output];

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
