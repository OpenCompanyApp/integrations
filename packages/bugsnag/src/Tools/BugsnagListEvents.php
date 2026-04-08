<?php

namespace OpenCompany\Integrations\Bugsnag\Tools;

use OpenCompany\Integrations\Bugsnag\BugsnagService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BugsnagListEvents implements Tool
{
    public function __construct(
        private BugsnagService $service,
    ) {}

    public function name(): string
    {
        return 'bugsnag_list_events';
    }

    public function description(): string
    {
        return 'List events (individual error occurrences) for a Bugsnag project. Optionally filter by a specific error.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID to list events for.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of events to return (default: 30).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of events to skip for pagination (default: 0).'],
            'error_id' => ['type' => 'string', 'description' => 'Filter events to a specific error by its ID.'],
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
            $errorId = $args['error_id'] ?? null;

            $result = $this->service->listEvents($projectId, $limit, $offset, $errorId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
