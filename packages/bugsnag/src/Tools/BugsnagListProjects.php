<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

use OpenCompany\Integrations\Bugsnag\BugsnagService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BugsnagListProjects implements Tool
{
    public function __construct(
        private BugsnagService $service,
    ) {}

    public function name(): string
    {
        return 'bugsnag_list_projects';
    }

    public function description(): string
    {
        return 'List Bugsnag projects visible to the authenticated user. Returns project names and IDs that can be used with other tools.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of projects to return (default: 30).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of projects to skip for pagination (default: 0).'],
            'q' => ['type' => 'string', 'description' => 'Search query to filter projects by name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bugsnag integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 30;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $q = $args['q'] ?? null;

            $result = $this->service->listProjects($limit, $offset, $q);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
