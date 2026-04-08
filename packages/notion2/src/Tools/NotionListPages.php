<?php

namespace OpenCompany\Integrations\Notion2\Tools;

use OpenCompany\Integrations\Notion2\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NotionListPages implements Tool
{
    public function __construct(private NotionService $service) {}

    public function name(): string { return 'notion2_list_pages'; }
    public function description(): string { return 'Search and list pages in your Notion workspace.'; }

    public function parameters(): array
    {
        return [
            'query'       => ['type' => 'string',  'description' => 'Search query to filter pages by title.'],
            'filter'      => ['type' => 'object',  'description' => 'Filter object, e.g. {"property":"object","value":"page"}.'],
            'sort'        => ['type' => 'object',  'description' => 'Sort object, e.g. {"direction":"descending","timestamp":"last_edited_time"}.'],
            'start_cursor'=> ['type' => 'string',  'description' => 'Cursor for pagination from a previous response.'],
            'page_size'   => ['type' => 'integer', 'description' => 'Number of results per page (1–100, default 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) { return ToolResult::error('Notion integration is not configured.'); }
            $params = [];
            if (isset($args['query'])) { $params['query'] = $args['query']; }
            if (isset($args['filter'])) { $params['filter'] = $args['filter']; }
            if (isset($args['sort'])) { $params['sort'] = $args['sort']; }
            if (isset($args['start_cursor'])) { $params['start_cursor'] = $args['start_cursor']; }
            if (isset($args['page_size'])) { $params['page_size'] = (int) $args['page_size']; }
            $pages = $this->service->listPages($params);
            return ToolResult::success($pages);
        } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); }
    }
}
