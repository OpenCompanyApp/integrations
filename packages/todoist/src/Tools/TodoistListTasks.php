<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\Integrations\Todoist\TodoistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TodoistListTasks implements Tool
{
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string { return 'todoist_list_tasks'; }
    public function description(): string { return 'List tasks in Todoist with optional filters.'; }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string',  'description' => 'Filter tasks by project ID.'],
            'section_id' => ['type' => 'string',  'description' => 'Filter tasks by section ID.'],
            'label'      => ['type' => 'string',  'description' => 'Filter tasks by label name.'],
            'filter'     => ['type' => 'string',  'description' => 'Todoist filter expression (e.g. "today", "p1 & @email").'],
            'lang'       => ['type' => 'string',  'description' => 'Language for filter evaluation (e.g. "en").'],
            'ids'        => ['type' => 'array',   'description' => 'Array of task IDs to fetch.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }
            $params = [];
            if (isset($args['project_id'])) { $params['project_id'] = $args['project_id']; }
            if (isset($args['section_id'])) { $params['section_id'] = $args['section_id']; }
            if (isset($args['label']))      { $params['label'] = $args['label']; }
            if (isset($args['filter']))     { $params['filter'] = $args['filter']; }
            if (isset($args['lang']))       { $params['lang'] = $args['lang']; }
            if (isset($args['ids']))        { $params['ids'] = $args['ids']; }
            $tasks = $this->service->listTasks($params);
            return ToolResult::success($tasks);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
