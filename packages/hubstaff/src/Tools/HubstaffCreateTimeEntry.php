<?php

namespace OpenCompany\Integrations\Hubstaff\Tools;

use OpenCompany\Integrations\Hubstaff\HubstaffService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HubstaffCreateTimeEntry implements Tool
{
    public function __construct(
        private HubstaffService $service,
    ) {}

    public function name(): string
    {
        return 'hubstaff_create_time_entry';
    }

    public function description(): string
    {
        return 'Create a new manual time entry in Hubstaff. Requires a project ID, date, and duration. Optionally add notes to describe the work performed.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the project to log time against.'],
            'date' => ['type' => 'string', 'required' => true, 'description' => 'The date for the time entry (ISO 8601, e.g., "2026-04-06").'],
            'duration' => ['type' => 'integer', 'required' => true, 'description' => 'Duration in seconds (e.g., 3600 for 1 hour).'],
            'notes' => ['type' => 'string', 'description' => 'Notes describing the work performed in this time entry.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hubstaff integration is not configured.');
            }

            $data = [
                'project_id' => (int) $args['project_id'],
                'date' => $args['date'],
                'duration' => (int) $args['duration'],
            ];

            if (isset($args['notes'])) {
                $data['notes'] = $args['notes'];
            }

            $result = $this->service->createTimeEntry($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
