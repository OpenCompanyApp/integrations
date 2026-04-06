<?php

namespace OpenCompany\Integrations\TogglTrack\Tools;

use OpenCompany\Integrations\TogglTrack\TogglTrackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * TogglGetProject — Retrieve a single project by its ID.
 *
 * Fetches the full details of a specific project from Toggl Track,
 * including name, color, billable settings, and estimated hours.
 *
 * @see https://developers.track.toggl.com/docs/api/projects#get-project
 */
class TogglGetProject implements Tool
{
    /**
     * Create a new TogglGetProject tool instance.
     */
    public function __construct(
        private TogglTrackService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'toggl_get_project';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Toggl Track project by its ID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID.'],
        ];
    }

    /**
     * Execute the tool — fetch a single project.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The project details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Toggl Track integration is not configured.');
            }

            $result = $this->service->getProject((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
