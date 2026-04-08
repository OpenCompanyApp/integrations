<?php

namespace OpenCompany\Integrations\Datadog\Tools;

use OpenCompany\Integrations\Datadog\DatadogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to post an event to the Datadog event stream.
 *
 * Events appear in the Datadog event timeline and can trigger monitors.
 */
class DatadogPostEvent implements Tool
{
    /**
     * Create a new DatadogPostEvent tool instance.
     *
     * @param  DatadogService  $service  The Datadog API service
     */
    public function __construct(
        private DatadogService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'datadog_post_event';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Post an event to the Datadog event stream. Specify title, text, priority, tags, and alert type. Events appear in the event timeline.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'Event title.'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'Event body text. Supports Markdown.'],
            'priority' => ['type' => 'string', 'description' => 'Event priority: "normal" or "low". Defaults to "normal".'],
            'tags' => ['type' => 'array', 'description' => 'List of tags for the event (e.g., ["env:production", "service:api"]).'],
            'alert_type' => ['type' => 'string', 'description' => 'Alert type: "info", "warning", "error", or "success". Defaults to "info".'],
            'date_happened' => ['type' => 'integer', 'description' => 'Unix timestamp for when the event occurred. Defaults to now.'],
            'source_type_name' => ['type' => 'string', 'description' => 'Source type name (e.g., "my_app").'],
            'host' => ['type' => 'string', 'description' => 'Host name to associate with the event.'],
            'aggregation_key' => ['type' => 'string', 'description' => 'Key to group related events together.'],
        ];
    }

    /**
     * Execute the tool and post the event.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Datadog integration is not configured.');
            }

            $body = [
                'title' => $args['title'],
                'text' => $args['text'],
            ];

            if (isset($args['priority'])) {
                $body['priority'] = $args['priority'];
            }

            if (isset($args['tags'])) {
                $body['tags'] = $args['tags'];
            }

            if (isset($args['alert_type'])) {
                $body['alert_type'] = $args['alert_type'];
            }

            if (isset($args['date_happened'])) {
                $body['date_happened'] = (int) $args['date_happened'];
            }

            if (isset($args['source_type_name'])) {
                $body['source_type_name'] = $args['source_type_name'];
            }

            if (isset($args['host'])) {
                $body['host'] = $args['host'];
            }

            if (isset($args['aggregation_key'])) {
                $body['aggregation_key'] = $args['aggregation_key'];
            }

            $result = $this->service->postEvent($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
