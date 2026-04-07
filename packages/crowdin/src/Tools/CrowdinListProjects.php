<?php

namespace OpenCompany\Integrations\Crowdin\Tools;

use OpenCompany\Integrations\Crowdin\CrowdinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List projects from the Crowdin API.
 *
 * Returns a paginated list of projects with their IDs, names, and metadata.
 */
class CrowdinListProjects implements Tool
{
    public function __construct(
        private CrowdinService $service,
    ) {}

    public function name(): string
    {
        return 'crowdin_list_projects';
    }

    public function description(): string
    {
        return 'List Crowdin projects. Returns project IDs, names, target languages, and other metadata. Supports pagination and filtering by group.';
    }

    public function parameters(): array
    {
        return [
            'group_id' => ['type' => 'integer', 'description' => 'Filter projects by group ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of projects to return (max 500, default 25).'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset (default 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Crowdin integration is not configured.');
            }

            $groupId = $args['group_id'] ?? null;
            $limit = $args['limit'] ?? 25;
            $offset = $args['offset'] ?? 0;

            $result = $this->service->listProjects($groupId, $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
