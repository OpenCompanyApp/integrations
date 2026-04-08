<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for creating a new feature flag in PostHog.
 */
class PostHogCreateFeatureFlag implements Tool
{
    /**
     * Create a new PostHogCreateFeatureFlag tool instance.
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
        return 'posthog_create_feature_flag';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Create a new feature flag in PostHog with a name, key, and optional rollout configuration.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Human-readable name for the feature flag (e.g., "New checkout flow").'],
            'key' => ['type' => 'string', 'required' => true, 'description' => 'Unique key used to reference the flag in code (e.g., "new-checkout"). Must be lowercase with hyphens.'],
            'active' => ['type' => 'boolean', 'description' => 'Whether the flag should be active immediately (default: true).'],
            'filters' => ['type' => 'object', 'description' => 'Optional filter conditions for targeting specific users or groups.'],
            'rollout_percentage' => ['type' => 'integer', 'description' => 'Percentage of users to roll out to (0–100). Omit for 100%.'],
        ];
    }

    /**
     * Execute the create feature flag tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments for creating the flag.
     * @return ToolResult The result containing the created feature flag.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PostHog integration is not configured.');
            }

            $name = $args['name'] ?? '';
            $key = $args['key'] ?? '';

            if (empty($name)) {
                return ToolResult::error('The "name" parameter is required.');
            }
            if (empty($key)) {
                return ToolResult::error('The "key" parameter is required.');
            }

            $result = $this->service->createFeatureFlag(
                name: $name,
                key: $key,
                active: $args['active'] ?? true,
                filters: $args['filters'] ?? null,
                rolloutPercentage: $args['rollout_percentage'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
