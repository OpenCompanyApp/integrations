<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing events from PostHog with filtering and pagination.
 */
class PostHogListEvents implements Tool
{
    /**
     * Create a new PostHogListEvents tool instance.
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
        return 'posthog_list_events';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List events from PostHog with optional filtering by event name, user, date range, and pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of events to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of events to skip for pagination (default: 0).'],
            'event' => ['type' => 'string', 'description' => 'Filter by event name (e.g., "$pageview", "signup").'],
            'distinct_id' => ['type' => 'string', 'description' => 'Filter by distinct user ID.'],
            'person_id' => ['type' => 'string', 'description' => 'Filter by internal person UUID.'],
            'after' => ['type' => 'string', 'description' => 'Only return events after this timestamp (ISO 8601, e.g., "2025-01-01T00:00:00Z").'],
            'before' => ['type' => 'string', 'description' => 'Only return events before this timestamp (ISO 8601, e.g., "2025-12-31T23:59:59Z").'],
        ];
    }

    /**
     * Execute the list events tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments for filtering and pagination.
     * @return ToolResult The result containing the list of events.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PostHog integration is not configured.');
            }

            $result = $this->service->listEvents(
                limit: isset($args['limit']) ? (int) $args['limit'] : 100,
                offset: isset($args['offset']) ? (int) $args['offset'] : 0,
                event: $args['event'] ?? null,
                distinctId: $args['distinct_id'] ?? null,
                personId: $args['person_id'] ?? null,
                after: $args['after'] ?? null,
                before: $args['before'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
