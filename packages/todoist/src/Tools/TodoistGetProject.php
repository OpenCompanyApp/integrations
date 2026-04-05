<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\Integrations\Core\Contracts\Tool;
use OpenCompany\Integrations\Core\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * Retrieve a single Todoist project by its ID.
 */
class TodoistGetProject implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_get_project';
    }

    public function description(): string
    {
        return 'Retrieve a single Todoist project by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the project to retrieve.'],
        ];
    }

    /**
     * Retrieve a Todoist project by ID.
     *
     * @param array<string, mixed> $args Must contain 'id' with the project ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            $result = $this->service->getProject($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
