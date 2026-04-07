<?php

namespace OpenCompany\Integrations\Wrike\Tools;

use OpenCompany\Integrations\Wrike\WrikeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List projects in Wrike with optional filters.
 */
class WrikeListProjects implements Tool
{
    /**
     * @param  WrikeService  $service  The Wrike API client
     */
    public function __construct(
        private WrikeService $service,
    ) {}

    public function name(): string
    {
        return 'wrike_list_projects';
    }

    public function description(): string
    {
        return 'List projects in Wrike with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'status'        => ['type' => 'string',  'description' => 'Filter by project status (Active, Completed, Deferred).'],
            'limit'         => ['type' => 'integer', 'description' => 'Max number of projects to return.'],
            'nextPageToken' => ['type' => 'string',  'description' => 'Cursor for pagination from a previous response.'],
        ];
    }

    /**
     * Retrieve a list of projects with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (status, limit, nextPageToken)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Wrike integration is not configured.');
            }

            $params = [];

            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['nextPageToken'])) {
                $params['nextPageToken'] = $args['nextPageToken'];
            }

            $projects = $this->service->listProjects($params);

            return ToolResult::success($projects);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
