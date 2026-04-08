<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving a single PostHog feature flag by its ID.
 */
class PostHogGetFeatureFlag implements Tool
{
    /**
     * Create a new PostHogGetFeatureFlag tool instance.
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
        return 'posthog_get_feature_flag';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific PostHog feature flag by its ID, including rollout configuration and filter conditions.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'flag_id' => ['type' => 'integer', 'required' => true, 'description' => 'The unique identifier of the feature flag to retrieve.'],
        ];
    }

    /**
     * Execute the get feature flag tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments containing flag_id.
     * @return ToolResult The result containing the feature flag details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PostHog integration is not configured.');
            }

            $flagId = $args['flag_id'] ?? null;
            if ($flagId === null || $flagId === '') {
                return ToolResult::error('The "flag_id" parameter is required.');
            }

            $result = $this->service->getFeatureFlag((int) $flagId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
