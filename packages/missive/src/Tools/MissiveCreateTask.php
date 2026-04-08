<?php

namespace OpenCompany\Integrations\Missive\Tools;

use OpenCompany\Integrations\Missive\MissiveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: missive_create_task
 *
 * Create a new task in Missive with title, description, assignee, and optional due date.
 */
class MissiveCreateTask implements Tool
{
    /**
     * @param  MissiveService  $service  The Missive API service instance.
     */
    public function __construct(
        private MissiveService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'missive_create_task';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new task in Missive. Requires a title. Optionally set description, assignee, and due date.';
    }

    /**
     * Define the accepted parameters.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The task title.'],
            'description' => ['type' => 'string', 'description' => 'Detailed description of the task. Supports Markdown.'],
            'assignee' => ['type' => 'string', 'description' => 'User ID or email of the person to assign the task to.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date in ISO 8601 format (e.g., "2025-12-31").'],
        ];
    }

    /**
     * Execute the tool — create a task in Missive.
     *
     * @param  array<string, mixed>  $args  The input parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Missive integration is not configured.');
            }

            $title = $args['title'] ?? '';

            if (empty($title)) {
                return ToolResult::error('Task title is required.');
            }

            $data = [
                'title' => $title,
            ];

            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['assignee'])) {
                $data['assignee'] = $args['assignee'];
            }
            if (isset($args['due_date'])) {
                $data['due_date'] = $args['due_date'];
            }

            $result = $this->service->createTask($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
