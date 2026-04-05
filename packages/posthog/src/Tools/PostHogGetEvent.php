<?php

namespace OpenCompany\Integrations\PostHog\Tools;

use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving a single PostHog event by its ID.
 */
class PostHogGetEvent implements Tool
{
    /**
     * Create a new PostHogGetEvent tool instance.
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
        return 'posthog_get_event';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific PostHog event by its unique ID, including all event properties and metadata.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>> Parameter definitions keyed by name.
     */
    public function parameters(): array
    {
        return [
            'event_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the event to retrieve.'],
        ];
    }

    /**
     * Execute the get event tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments containing event_id.
     * @return ToolResult The result containing the event details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PostHog integration is not configured.');
            }

            $eventId = $args['event_id'] ?? '';
            if (empty($eventId)) {
                return ToolResult::error('The "event_id" parameter is required.');
            }

            $result = $this->service->getEvent($eventId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
