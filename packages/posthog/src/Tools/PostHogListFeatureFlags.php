<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing all feature flags in a PostHog project.
 */
class PostHogListFeatureFlags implements Tool
{
    /**
     * Create a new PostHogListFeatureFlags tool instance.
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
        return 'posthog_list_feature_flags';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List all feature flags in the PostHog project, including their status, rollout percentages, and filter conditions.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of feature flags to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of feature flags to skip for pagination (default: 0).'],
        ];
    }

    /**
     * Execute the list feature flags tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments for pagination.
     * @return ToolResult The result containing the list of feature flags.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PostHog integration is not configured.');
            }

            $result = $this->service->listFeatureFlags(
                limit: isset($args['limit']) ? (int) $args['limit'] : 100,
                offset: isset($args['offset']) ? (int) $args['offset'] : 0,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
