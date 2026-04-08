<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing dashboards from PostHog.
 */
class PostHogListDashboards implements Tool
{
    /**
     * Create a new PostHogListDashboards tool instance.
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
        return 'posthog_list_dashboards';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List dashboards in the PostHog project. Dashboards contain collections of insights organized for monitoring.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of dashboards to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of dashboards to skip for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the list dashboards tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments for pagination.
     * @return ToolResult The result containing the list of dashboards.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PostHog integration is not configured.');
            }

            $result = $this->service->listDashboards(
                limit: isset($args['limit']) ? (int) $args['limit'] : 100,
                offset: isset($args['offset']) ? (int) $args['offset'] : 0,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
