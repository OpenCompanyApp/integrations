<?php

namespace OpenCompany\Integrations\TogglTrack\Tools;

use OpenCompany\Integrations\TogglTrack\TogglTrackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * TogglListTimeEntries — List time entries for the authenticated user.
 *
 * Retrieves time entries from Toggl Track with optional filtering by date range,
 * workspace, project, and result limit.
 *
 * @see https://developers.track.toggl.com/docs/api/time_entries#get-timeentries
 */
class TogglListTimeEntries implements Tool
{
    /**
     * Create a new TogglListTimeEntries tool instance.
     */
    public function __construct(
        private TogglTrackService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'toggl_list_time_entries';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'List time entries from Toggl Track. Filter by date range, workspace, or project. Returns recent time entries by default.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'start_date' => ['type' => 'string', 'description' => 'Start date for the range (ISO 8601, e.g., "2025-01-01T00:00:00Z").'],
            'end_date' => ['type' => 'string', 'description' => 'End date for the range (ISO 8601, e.g., "2025-01-31T23:59:59Z").'],
            'workspace_id' => ['type' => 'integer', 'description' => 'Filter by workspace ID.'],
            'project_id' => ['type' => 'integer', 'description' => 'Filter by project ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of time entries to return.'],
        ];
    }

    /**
     * Execute the tool — list time entries based on provided filters.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The list of time entries or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Toggl Track integration is not configured.');
            }

            $params = [];

            if (isset($args['start_date'])) {
                $params['start_date'] = $args['start_date'];
            }
            if (isset($args['end_date'])) {
                $params['end_date'] = $args['end_date'];
            }
            if (isset($args['workspace_id'])) {
                $params['workspace_id'] = (int) $args['workspace_id'];
            }
            if (isset($args['project_id'])) {
                $params['project_id'] = (int) $args['project_id'];
            }

            $result = $this->service->listTimeEntries($params);

            if (isset($args['limit']) && is_array($result)) {
                $limit = (int) $args['limit'];
                $result = array_slice($result, 0, $limit);
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
