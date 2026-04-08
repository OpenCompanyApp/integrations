<?php

namespace OpenCompany\Integrations\Litmos\Tools;

use OpenCompany\Integrations\Litmos\LitmosService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List courses in the Litmos LMS.
 *
 * Supports pagination and optional search filtering by course name.
 */
class LitmosListCourses implements Tool
{
    public function __construct(
        private LitmosService $service,
    ) {}

    public function name(): string
    {
        return 'litmos_list_courses';
    }

    public function description(): string
    {
        return 'List courses in your Litmos organization. Returns course IDs, names, descriptions, and status. Supports pagination and search.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of courses to return per page (default: 100, max: 1000).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'search' => ['type' => 'string', 'description' => 'Search term to filter courses by name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Litmos integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $search = $args['search'] ?? null;

            $result = $this->service->listCourses($limit, $page, $search);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
