<?php

namespace OpenCompany\Integrations\Toggl\Tools;

use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: toggl_get_project
 *
 * Gets details for a single Toggl project.
 */
class TogglGetProject implements Tool
{
    public function __construct(
        private TogglService $service,
    ) {}

    public function name(): string
    {
        return 'toggl_get_project';
    }

    public function description(): string
    {
        return 'Get details for a single Toggl project by ID.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'required' => true, 'description' => 'The workspace ID.'],
            'project_id'   => ['type' => 'string', 'required' => true, 'description' => 'The project ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Toggl integration is not configured.');
            }

            $result = $this->service->getProject($args['workspace_id'], $args['project_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
