<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

use OpenCompany\Integrations\Bugsnag\BugsnagService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BugsnagListErrors implements Tool
{
    public function __construct(
        private BugsnagService $service,
    ) {}

    public function name(): string
    {
        return 'bugsnag_list_errors';
    }

    public function description(): string
    {
        return 'List errors for a Bugsnag project. Supports filtering by severity and status, and sorting by various fields.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID to list errors for.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of errors to return (default: 30).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of errors to skip for pagination (default: 0).'],
            'severity' => ['type' => 'string', 'description' => 'Filter by severity: "error", "warning", or "info".'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "open", "fixed", or "snoozed".'],
            'sort' => ['type' => 'string', 'description' => 'Sort order: "created_at", "updated_at", or "unhandled_occurrence_count".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bugsnag integration is not configured.');
            }

            $projectId = $args['project_id'] ?? '';

            if (empty($projectId)) {
                return ToolResult::error('Project ID is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 30;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $severity = $args['severity'] ?? null;
            $status = $args['status'] ?? null;
            $sort = $args['sort'] ?? null;

            $result = $this->service->listErrors($projectId, $limit, $offset, $severity, $status, $sort);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
