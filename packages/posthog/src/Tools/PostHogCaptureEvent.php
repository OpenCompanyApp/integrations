<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for capturing (sending) custom events to PostHog.
 *
 * Uses the /e/ capture endpoint. Note: the capture endpoint accepts the
 * project API key rather than a personal access token for authentication.
 */
class PostHogCaptureEvent implements Tool
{
    /**
     * Create a new PostHogCaptureEvent tool instance.
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
        return 'posthog_capture_event';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Send (capture) a custom event to PostHog for a specific user. The event will appear in the PostHog events stream and can be used in insights and funnels.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'event' => ['type' => 'string', 'required' => true, 'description' => 'The name of the event to capture (e.g., "signup", "purchase", "button_clicked").'],
            'distinct_id' => ['type' => 'string', 'required' => true, 'description' => 'A unique identifier for the user performing the event (e.g., user ID, email, or anonymous ID).'],
            'properties' => ['type' => 'object', 'description' => 'Optional key-value properties to attach to the event.'],
            'timestamp' => ['type' => 'string', 'description' => 'Optional ISO 8601 timestamp for the event. Defaults to the current server time.'],
        ];
    }

    /**
     * Execute the capture event tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments containing event, distinct_id, and optional properties/timestamp.
     * @return ToolResult The result of the event capture operation.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PostHog integration is not configured.');
            }

            $event = $args['event'] ?? '';
            $distinctId = $args['distinct_id'] ?? '';

            if (empty($event)) {
                return ToolResult::error('The "event" parameter is required.');
            }
            if (empty($distinctId)) {
                return ToolResult::error('The "distinct_id" parameter is required.');
            }

            $properties = $args['properties'] ?? [];
            $timestamp = $args['timestamp'] ?? null;

            $result = $this->service->captureEvent($distinctId, $event, $properties, $timestamp);

            return ToolResult::success([
                'message' => "Event '{$event}' captured successfully for user '{$distinctId}'.",
                'result' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
