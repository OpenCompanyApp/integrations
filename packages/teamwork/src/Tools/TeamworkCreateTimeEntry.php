<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: teamwork_create_time_entry
 *
 * Create a time entry in a Teamwork project.
 */
class TeamworkCreateTimeEntry implements Tool
{
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_create_time_entry';
    }

    public function description(): string
    {
        return 'Log a time entry against a Teamwork project. Provide the project ID and time details (hours, minutes, date, description).';
    }

    public function parameters(): array
    {
        return [
            'project_id'   => ['type' => 'integer', 'required' => true,  'description' => 'The project ID to log time against.'],
            'hours'        => ['type' => 'integer', 'required' => true,  'description' => 'Number of hours.'],
            'minutes'      => ['type' => 'integer', 'description' => 'Additional minutes (optional).'],
            'date'         => ['type' => 'string',  'required' => true,  'description' => 'Date for the time entry in ISO 8601 format (e.g., "2026-04-05").'],
            'description'  => ['type' => 'string',  'description' => 'Description of the work done.'],
            'task_id'      => ['type' => 'integer', 'description' => 'Associate this time entry with a specific task.'],
            'userId'       => ['type' => 'integer', 'description' => 'User ID to log time for (defaults to the authenticated user).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $projectId = (int) $args['project_id'];

            $data = [
                'hours' => (int) $args['hours'],
                'date'  => $args['date'],
            ];

            if (isset($args['minutes']))     $data['minutes']     = (int) $args['minutes'];
            if (isset($args['description'])) $data['description'] = $args['description'];
            if (isset($args['task_id']))     $data['taskId']      = (int) $args['task_id'];
            if (isset($args['userId']))      $data['userId']      = (int) $args['userId'];

            $result = $this->service->createTimeEntry($projectId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
