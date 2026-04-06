<?php

namespace OpenCompany\Integrations\Accelo\Tools;

use OpenCompany\Integrations\Accelo\AcceloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: accelo_list_projects
 *
 * Lists projects from Accelo with optional filtering by status
 * and pagination support via limit/page parameters.
 */
class AcceloListProjects implements Tool
{
    public function __construct(
        private AcceloService $service,
    ) {}

    public function name(): string
    {
        return 'accelo_list_projects';
    }

    public function description(): string
    {
        return 'List projects in Accelo. Returns a paginated list of projects, optionally filtered by status.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of projects to return per page (default: 25, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'status' => ['type' => 'string', 'description' => 'Filter projects by status (e.g. "open", "completed", "in_progress").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Accelo integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $status = $args['status'] ?? null;

            $result = $this->service->listProjects($limit, $page, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
