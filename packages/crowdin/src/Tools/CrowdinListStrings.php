<?php

namespace OpenCompany\Integrations\Crowdin\Tools;

use OpenCompany\Integrations\Crowdin\CrowdinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List source strings in a Crowdin project.
 *
 * Returns a paginated list of strings with their IDs, text, and context.
 */
class CrowdinListStrings implements Tool
{
    public function __construct(
        private CrowdinService $service,
    ) {}

    public function name(): string
    {
        return 'crowdin_list_strings';
    }

    public function description(): string
    {
        return 'List source strings in a Crowdin project. Returns string IDs, text, context, and file associations. Supports filtering by file or branch.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID.'],
            'file_id' => ['type' => 'integer', 'description' => 'Filter strings by file ID.'],
            'branch_id' => ['type' => 'integer', 'description' => 'Filter strings by branch ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of strings to return (default 25).'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset (default 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Crowdin integration is not configured.');
            }

            $projectId = $args['project_id'];
            $fileId = $args['file_id'] ?? null;
            $branchId = $args['branch_id'] ?? null;
            $limit = $args['limit'] ?? 25;
            $offset = $args['offset'] ?? 0;

            $result = $this->service->listStrings($projectId, $fileId, $branchId, $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
