<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing insights from PostHog.
 */
class PostHogListInsights implements Tool
{
    /**
     * Create a new PostHogListInsights tool instance.
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
        return 'posthog_list_insights';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List saved insights in the PostHog project. Optionally filter by insight type (e.g., TRENDS, FUNNELS, RETENTION, PATHS).';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of insights to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of insights to skip for pagination (default: 0).'],
            'type' => ['type' => 'string', 'description' => 'Filter by insight type: TRENDS, FUNNELS, RETENTION, PATHS, LIFECYCLE, or STICKINESS.'],
        ];
    }

    /**
     * Execute the list insights tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments for filtering and pagination.
     * @return ToolResult The result containing the list of insights.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PostHog integration is not configured.');
            }

            $result = $this->service->listInsights(
                limit: isset($args['limit']) ? (int) $args['limit'] : 100,
                offset: isset($args['offset']) ? (int) $args['offset'] : 0,
                type: $args['type'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
