<?php

namespace OpenCompany\Integrations\Thinkific\Tools;

use OpenCompany\Integrations\Thinkific\ThinkificService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List courses in Thinkific.
 *
 * Supports pagination and optional search filtering.
 */
class ThinkificListCourses implements Tool
{
    public function __construct(
        private ThinkificService $service,
    ) {}

    public function name(): string
    {
        return 'thinkific_list_courses';
    }

    public function description(): string
    {
        return 'List courses in your Thinkific site. Returns course IDs, names, descriptions, and status. Supports pagination and search.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of courses to return per page (default: 25, max: 250).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'query' => ['type' => 'string', 'description' => 'Search term to filter courses by name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Thinkific integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $query = $args['query'] ?? null;

            $result = $this->service->listCourses($limit, $page, $query);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
