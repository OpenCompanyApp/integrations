<?php

namespace OpenCompany\Integrations\Hubstaff\Tools;

use OpenCompany\Integrations\Hubstaff\HubstaffService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HubstaffListProjects implements Tool
{
    public function __construct(
        private HubstaffService $service,
    ) {}

    public function name(): string
    {
        return 'hubstaff_list_projects';
    }

    public function description(): string
    {
        return 'List projects from Hubstaff. Optionally filter by status (active, archived). Supports pagination to browse through large numbers of projects.';
    }

    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by project status: "active" or "archived".'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of projects to return per page (default: 50).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hubstaff integration is not configured.');
            }

            $params = [];

            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listProjects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
