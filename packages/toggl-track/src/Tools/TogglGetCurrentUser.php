<?php

namespace OpenCompany\Integrations\TogglTrack\Tools;

use OpenCompany\Integrations\TogglTrack\TogglTrackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * TogglGetCurrentUser — Retrieve the authenticated user's profile.
 *
 * Fetches the current user's Toggl Track profile including email, full name,
 * default workspace, and time zone settings.
 *
 * @see https://developers.track.toggl.com/docs/api/me#get-me
 */
class TogglGetCurrentUser implements Tool
{
    /**
     * Create a new TogglGetCurrentUser tool instance.
     */
    public function __construct(
        private TogglTrackService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'toggl_get_current_user';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'Get the authenticated Toggl Track user profile, including email, name, default workspace, and time zone.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, mixed> Empty — this tool takes no parameters.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — fetch the current user profile.
     *
     * @param  array<string, mixed>  $args  The tool arguments (unused).
     * @return ToolResult The user profile data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Toggl Track integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
