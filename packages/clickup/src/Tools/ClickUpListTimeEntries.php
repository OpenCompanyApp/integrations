<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpListTimeEntries implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_list_time_entries';
    }

    public function description(): string
    {
        return 'Get all time entries for a ClickUp task.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task ID. Supports custom IDs like "DEV-42".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $taskId = $args['task_id'] ?? '';
            if (empty($taskId)) {
                return ToolResult::error('task_id is required.');
            }

            $queryParams = $this->service->withCustomIdParams($taskId);

            $result = $this->service->getTaskTimeEntries($taskId, $queryParams);
            $entries = $result['data'] ?? [];

            if (empty($entries)) {
                return ToolResult::success('No time entries found for this task.');
            }

            $output = array_map(fn (array $e) => [
                'id' => $e['id'] ?? '',
                'user' => $e['user']['username'] ?? '',
                'duration' => isset($e['duration']) ? round((int) $e['duration'] / 60000, 1) . ' min' : '',
                'description' => $e['description'] ?? '',
                'start' => isset($e['start']) ? ClickUpService::fromMillis((int) $e['start']) : '',
                'end' => isset($e['end']) ? ClickUpService::fromMillis((int) $e['end']) : '',
                'billable' => $e['billable'] ?? false,
            ], $entries);

            return ToolResult::success(['count' => count($output), 'entries' => $output]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
