<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for deleting a feature flag from PostHog.
 */
class PostHogDeleteFeatureFlag implements Tool
{
    /**
     * Create a new PostHogDeleteFeatureFlag tool instance.
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
        return 'posthog_delete_feature_flag';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Delete a feature flag from PostHog. This action is permanent and cannot be undone.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'flag_id' => ['type' => 'integer', 'required' => true, 'description' => 'The unique identifier of the feature flag to delete.'],
        ];
    }

    /**
     * Execute the delete feature flag tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments containing flag_id.
     * @return ToolResult The result confirming the deletion.
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

            $this->service->deleteFeatureFlag((int) $flagId);

            return ToolResult::success("Feature flag {$flagId} has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
