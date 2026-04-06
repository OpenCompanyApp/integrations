<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * List all personal labels in the authenticated user's Todoist account.
 */
class TodoistListLabels implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_list_labels';
    }

    public function description(): string
    {
        return 'List all personal labels available in the user\'s Todoist account.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all Todoist personal labels.
     *
     * @param array<string, mixed> $args No parameters required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            $result = $this->service->listLabels();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
