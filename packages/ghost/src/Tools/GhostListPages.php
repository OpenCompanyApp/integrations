<?php

namespace OpenCompany\Integrations\Ghost\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Ghost\GhostService;

class GhostListPages implements Tool
{
    public function __construct(
        private GhostService $service,
    ) {}

    public function name(): string
    {
        return 'ghost_list_pages';
    }

    public function description(): string
    {
        return 'List static pages from Ghost CMS. Supports filtering, pagination, and ordering. Pages are non-blog content like "About", "Contact", etc.';
    }

    public function parameters(): array
    {
        return [
            'page' => [
                'type' => 'integer',
                'description' => 'Page number (default: 1).',
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Number of pages per page (default: 15, max: 100).',
            ],
            'filter' => [
                'type' => 'string',
                'description' => 'Ghost filter syntax, e.g. "status:published" or "slug:about". Use `+` for AND, `,` for OR.',
            ],
            'status' => [
                'type' => 'string',
                'enum' => ['published', 'draft'],
                'description' => 'Filter by page status. Shorthand for filter "status:{value}".',
            ],
            'order' => [
                'type' => 'string',
                'description' => 'Sort order (default: "published_at desc"). Examples: "title asc", "created_at desc".',
            ],
            'fields' => [
                'type' => 'string',
                'description' => 'Comma-separated list of fields to return (e.g. "id,title,slug,status").',
            ],
            'include' => [
                'type' => 'string',
                'description' => 'Comma-separated related data to include: "tags", "authors", "tags,authors".',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Ghost integration is not configured. Provide an Admin API key and base URL.');
            }

            $params = [];

            // Build filter
            $filterParts = [];
            if (! empty($args['status'])) {
                $filterParts[] = 'status:' . $args['status'];
            }

            $filter = '';
            if (! empty($filterParts)) {
                $filter = implode('+', $filterParts);
            }
            if (! empty($args['filter'])) {
                $filter = $filter ? $filter . '+' . $args['filter'] : $args['filter'];
            }

            if ($filter !== '') {
                $params['filter'] = $filter;
            }

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = min((int) $args['limit'], 100);
            }
            if (! empty($args['order'])) {
                $params['order'] = $args['order'];
            }
            if (! empty($args['fields'])) {
                $params['fields'] = $args['fields'];
            }
            if (! empty($args['include'])) {
                $params['include'] = $args['include'];
            }

            $result = $this->service->listPages($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
