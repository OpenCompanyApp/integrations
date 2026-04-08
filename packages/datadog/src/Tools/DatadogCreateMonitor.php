<?php

namespace OpenCompany\Integrations\Datadog\Tools;

use OpenCompany\Integrations\Datadog\DatadogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new Datadog monitor.
 *
 * Supports all monitor types: metric alert, service check, event alert, etc.
 */
class DatadogCreateMonitor implements Tool
{
    /**
     * Create a new DatadogCreateMonitor tool instance.
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
        return 'datadog_create_monitor';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new Datadog monitor. Specify the monitor type, query, name, and optional message and thresholds. Common types: "metric alert", "service check", "event alert".';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Monitor type: "metric alert", "service check", "event alert", "query alert", "composite", "log alert", "rum alert", etc.'],
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The monitor query (e.g., "avg(last_5m):avg:system.cpu.user{host:my-host} > 90").'],
            'name' => ['type' => 'string', 'description' => 'Display name for the monitor.'],
            'message' => ['type' => 'string', 'description' => 'Notification message. Supports @mention syntax (e.g., "@slack-my-channel").'],
            'priority' => ['type' => 'integer', 'description' => 'Monitor priority level (1-5, where 1 is highest).'],
            'options' => ['type' => 'object', 'description' => 'JSON-encoded monitor options: thresholds, notify_no_data, no_data_timeframe, renotify_interval, escalation_message, etc.'],
            'tags' => ['type' => 'array', 'description' => 'List of tags to assign to the monitor (e.g., ["env:production", "service:api"]).'],
        ];
    }

    /**
     * Execute the tool and create the monitor.
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
                'type' => $args['type'],
                'query' => $args['query'],
            ];

            if (isset($args['name'])) {
                $body['name'] = $args['name'];
            }

            if (isset($args['message'])) {
                $body['message'] = $args['message'];
            }

            if (isset($args['priority'])) {
                $body['priority'] = (int) $args['priority'];
            }

            if (isset($args['options'])) {
                $options = $args['options'];
                $body['options'] = is_string($options) ? json_decode($options, true) : $options;
            }

            if (isset($args['tags'])) {
                $body['tags'] = $args['tags'];
            }

            $result = $this->service->createMonitor($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
