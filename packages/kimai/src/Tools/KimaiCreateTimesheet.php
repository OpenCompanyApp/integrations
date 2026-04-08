<?php

namespace OpenCompany\Integrations\Kimai\Tools;

use OpenCompany\Integrations\Kimai\KimaiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KimaiCreateTimesheet implements Tool
{
    public function __construct(
        private KimaiService $service,
    ) {}

    public function name(): string
    {
        return 'kimai_create_timesheet';
    }

    public function description(): string
    {
        return 'Create a new time-tracking entry in Kimai. Requires a begin timestamp and at least a project ID. Optionally specify an end time, activity, and description to categorize the time entry.';
    }

    public function parameters(): array
    {
        return [
            'begin' => ['type' => 'string', 'required' => true, 'description' => 'Start time in ISO 8601 format (e.g., "2025-01-15T09:00:00").'],
            'end' => ['type' => 'string', 'description' => 'End time in ISO 8601 format (e.g., "2025-01-15T17:00:00"). Omit to start a running timer.'],
            'project' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID to associate the time entry with.'],
            'activity' => ['type' => 'integer', 'description' => 'The activity ID to categorize the time entry (e.g., "Development", "Meeting").'],
            'description' => ['type' => 'string', 'description' => 'A description of the work performed during this time entry.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kimai integration is not configured.');
            }

            $data = [
                'begin' => $args['begin'],
                'project' => (int) $args['project'],
            ];

            if (isset($args['end'])) {
                $data['end'] = $args['end'];
            }
            if (isset($args['activity'])) {
                $data['activity'] = (int) $args['activity'];
            }
            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }

            $result = $this->service->createTimesheet($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
