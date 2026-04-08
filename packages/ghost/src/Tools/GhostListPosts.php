<?php

namespace OpenCompany\Integrations\Ghost\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Ghost\GhostService;

class GhostListPosts implements Tool
{
    public function __construct(
        private GhostService $service,
    ) {}

    public function name(): string
    {
        return 'ghost_list_posts';
    }

    public function description(): string
    {
        return 'List blog posts from Ghost CMS. Supports filtering by tag, author, status, and free-text search. Returns paginated results with post titles, slugs, status, and metadata.';
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
                'description' => 'Number of posts per page (default: 15, max: 100).',
            ],
            'filter' => [
                'type' => 'string',
                'description' => 'Ghost filter syntax, e.g. "tag:news+status:published" or "author:john". Use `+` for AND, `,` for OR.',
            ],
            'tag' => [
                'type' => 'string',
                'description' => 'Filter by tag slug (e.g. "news", "engineering"). Shorthand for filter "tag:{value}".',
            ],
            'author' => [
                'type' => 'string',
                'description' => 'Filter by author slug (e.g. "john"). Shorthand for filter "author:{value}".',
            ],
            'status' => [
                'type' => 'string',
                'enum' => ['published', 'draft', 'scheduled'],
                'description' => 'Filter by post status. Shorthand for filter "status:{value}".',
            ],
            'order' => [
                'type' => 'string',
                'description' => 'Sort order (default: "published_at desc"). Examples: "created_at desc", "title asc", "updated_at desc".',
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

            // Build filter from individual shorthand params
            $filterParts = [];
            if (! empty($args['tag'])) {
                $filterParts[] = 'tag:' . $args['tag'];
            }
            if (! empty($args['author'])) {
                $filterParts[] = 'author:' . $args['author'];
            }
            if (! empty($args['status'])) {
                $filterParts[] = 'status:' . $args['status'];
            }

            // Combine shorthand filters with explicit filter param
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

            $result = $this->service->listPosts($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
