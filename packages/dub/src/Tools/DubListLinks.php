<?php

namespace OpenCompany\Integrations\Dub\Tools;

use OpenCompany\Integrations\Dub\DubService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DubListLinks implements Tool
{
    public function __construct(
        private DubService $service,
    ) {}

    public function name(): string
    {
        return 'dub_list_links';
    }

    public function description(): string
    {
        return 'List short links from Dub.co. Supports pagination, searching, and filtering by domain or tag.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50).'],
            'search' => ['type' => 'string', 'description' => 'Search query to filter links by URL, key, or title.'],
            'domain' => ['type' => 'string', 'description' => 'Filter links by domain (e.g., "lnkd.in", "dub.sh").'],
            'tagId' => ['type' => 'string', 'description' => 'Filter links by tag ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Dub.co integration is not configured.');
            }

            $result = $this->service->listLinks(
                page: isset($args['page']) ? (int) $args['page'] : 1,
                pageSize: isset($args['pageSize']) ? (int) $args['pageSize'] : 50,
                search: $args['search'] ?? null,
                domain: $args['domain'] ?? null,
                tagId: $args['tagId'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
