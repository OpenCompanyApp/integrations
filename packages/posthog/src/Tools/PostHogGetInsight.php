<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving a single PostHog insight by its ID.
 */
class PostHogGetInsight implements Tool
{
    /**
     * Create a new PostHogGetInsight tool instance.
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
        return 'posthog_get_insight';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific PostHog insight by its ID, including its query configuration and cached results.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'insight_id' => ['type' => 'integer', 'required' => true, 'description' => 'The unique identifier of the insight to retrieve.'],
        ];
    }

    /**
     * Execute the get insight tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments containing insight_id.
     * @return ToolResult The result containing the insight details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PostHog integration is not configured.');
            }

            $insightId = $args['insight_id'] ?? null;
            if ($insightId === null || $insightId === '') {
                return ToolResult::error('The "insight_id" parameter is required.');
            }

            $result = $this->service->getInsight((int) $insightId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
