<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving a single PostHog dashboard by its ID.
 */
class PostHogGetDashboard implements Tool
{
    /**
     * Create a new PostHogGetDashboard tool instance.
     *
     * @param  PostHogService  $service  The PostHog service for making API calls.
     */
    public function __construct(
        private PostHogService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string The unique tool name.
     */
    public function name(): string
    {
        return 'posthog_get_dashboard';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific PostHog dashboard by its ID, including its layout and contained insights.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'dashboard_id' => ['type' => 'integer', 'required' => true, 'description' => 'The unique identifier of the dashboard to retrieve.'],
        ];
    }

    /**
     * Execute the get dashboard tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments containing dashboard_id.
     * @return ToolResult The result containing the dashboard details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PostHog integration is not configured.');
            }

            $dashboardId = $args['dashboard_id'] ?? null;
            if ($dashboardId === null || $dashboardId === '') {
                return ToolResult::error('The "dashboard_id" parameter is required.');
            }

            $result = $this->service->getDashboard((int) $dashboardId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
