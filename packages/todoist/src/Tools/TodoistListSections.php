<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * List sections in a Todoist project.
 */
class TodoistListSections implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_list_sections';
    }

    public function description(): string
    {
        return 'List all sections, optionally filtered by a specific project ID.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => false, 'description' => 'Filter sections by project ID.'],
        ];
    }

    /**
     * List Todoist sections, optionally filtered by project.
     *
     * @param array<string, mixed> $args Optional 'project_id' to filter sections.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            $result = $this->service->listSections($args['project_id'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
