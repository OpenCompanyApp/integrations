<?php

namespace OpenCompany\Integrations\TogglTrack\Tools;

use OpenCompany\Integrations\TogglTrack\TogglTrackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * TogglCreateTimeEntry — Create a new time entry in Toggl Track.
 *
 * Starts or creates a time entry with the given description, duration, project,
 * tags, and other metadata. The workspace_id and start time are required.
 *
 * @see https://developers.track.toggl.com/docs/api/time_entries#post-timeentries
 */
class TogglCreateTimeEntry implements Tool
{
    /**
     * Create a new TogglCreateTimeEntry tool instance.
     */
    public function __construct(
        private TogglTrackService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'toggl_create_time_entry';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'Create a new time entry in Toggl Track. Provide a description, workspace, start time, and duration. Optionally assign to a project, add tags, or mark as billable.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'integer', 'required' => true, 'description' => 'The workspace ID where the time entry will be created.'],
            'description' => ['type' => 'string', 'description' => 'Description of the time entry (e.g., "Writing documentation").'],
            'duration' => ['type' => 'integer', 'description' => 'Duration in seconds. Use a negative value (e.g., -1) to start a running timer.'],
            'start' => ['type' => 'string', 'description' => 'Start time in ISO 8601 format (e.g., "2025-01-15T09:00:00Z"). Required for completed entries.'],
            'pid' => ['type' => 'integer', 'description' => 'Project ID to assign the time entry to.'],
            'tags' => ['type' => 'array', 'description' => 'List of tag names to apply (e.g., ["billing", "client-work"]).'],
            'billable' => ['type' => 'boolean', 'description' => 'Whether the time entry is billable (default: false).'],
            'created_with' => ['type' => 'string', 'description' => 'Name of the application that created the entry (default: "OpenCompany").'],
        ];
    }

    /**
     * Execute the tool — create a new time entry.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The created time entry or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Toggl Track integration is not configured.');
            }

            if (!isset($args['workspace_id'])) {
                return ToolResult::error('workspace_id is required to create a time entry.');
            }

            $data = [
                'workspace_id' => (int) $args['workspace_id'],
                'created_with' => $args['created_with'] ?? 'OpenCompany',
            ];

            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['duration'])) {
                $data['duration'] = (int) $args['duration'];
            }
            if (isset($args['start'])) {
                $data['start'] = $args['start'];
            }
            if (isset($args['pid'])) {
                $data['pid'] = (int) $args['pid'];
            }
            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }
            if (isset($args['billable'])) {
                $data['billable'] = (bool) $args['billable'];
            }

            $result = $this->service->createTimeEntry($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
