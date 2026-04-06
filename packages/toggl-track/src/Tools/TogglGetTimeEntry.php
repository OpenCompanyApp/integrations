<?php

namespace OpenCompany\Integrations\TogglTrack\Tools;

use OpenCompany\Integrations\TogglTrack\TogglTrackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * TogglGetTimeEntry — Retrieve a single time entry by ID.
 *
 * Fetches the full details of a specific time entry from Toggl Track.
 *
 * @see https://developers.track.toggl.com/docs/api/time_entries#get-get-a-time-entry
 */
class TogglGetTimeEntry implements Tool
{
    /**
     * Create a new TogglGetTimeEntry tool instance.
     */
    public function __construct(
        private TogglTrackService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'toggl_get_time_entry';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Toggl Track time entry by its ID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The time entry ID.'],
        ];
    }

    /**
     * Execute the tool — fetch a single time entry.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The time entry details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Toggl Track integration is not configured.');
            }

            $result = $this->service->getTimeEntry((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
