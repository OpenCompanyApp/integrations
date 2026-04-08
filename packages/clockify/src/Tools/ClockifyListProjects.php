<?php

namespace OpenCompany\Integrations\Clockify\Tools;

use OpenCompany\Integrations\Clockify\ClockifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clockify_list_projects
 *
 * Lists projects in a Clockify workspace with optional name filtering and pagination.
 */
class ClockifyListProjects implements Tool
{
    public function __construct(
        private ClockifyService $service,
    ) {}

    public function name(): string
    {
        return 'clockify_list_projects';
    }

    public function description(): string
    {
        return 'List projects in a Clockify workspace. Optionally filter by name and paginate results.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace ID.'],
            'name'         => ['type' => 'string', 'description' => 'Filter by project name (partial match).'],
            'page'         => ['type' => 'integer', 'description' => 'Page number (1-based, default: 1).'],
            'page_size'    => ['type' => 'integer', 'description' => 'Items per page (default: 50).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clockify integration is not configured.');
            }

            $result = $this->service->listProjects(
                workspaceId: $args['workspace_id'],
                name: $args['name'] ?? '',
                page: $args['page'] ?? 1,
                pageSize: $args['page_size'] ?? 50,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
