<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for updating an existing feature flag in PostHog.
 */
class PostHogUpdateFeatureFlag implements Tool
{
    /**
     * Create a new PostHogUpdateFeatureFlag tool instance.
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
        return 'posthog_update_feature_flag';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Update an existing PostHog feature flag — change its active state, filters, or rollout percentage.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'flag_id' => ['type' => 'integer', 'required' => true, 'description' => 'The unique identifier of the feature flag to update.'],
            'active' => ['type' => 'boolean', 'description' => 'Set the flag active (true) or inactive (false).'],
            'filters' => ['type' => 'object', 'description' => 'New filter conditions for targeting specific users or groups.'],
            'rollout_percentage' => ['type' => 'integer', 'description' => 'New rollout percentage (0–100).'],
        ];
    }

    /**
     * Execute the update feature flag tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments containing flag_id and optional update fields.
     * @return ToolResult The result containing the updated feature flag.
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

            $result = $this->service->updateFeatureFlag(
                flagId: (int) $flagId,
                active: $args['active'] ?? null,
                filters: $args['filters'] ?? null,
                rolloutPercentage: $args['rollout_percentage'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
