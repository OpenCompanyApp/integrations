<?php

namespace OpenCompany\Integrations\Datadog\Tools;

use OpenCompany\Integrations\Datadog\DatadogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to update an existing Datadog monitor.
 *
 * Allows modifying the query, name, message, thresholds, and other settings.
 */
class DatadogUpdateMonitor implements Tool
{
    /**
     * Create a new DatadogUpdateMonitor tool instance.
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
        return 'datadog_update_monitor';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Update an existing Datadog monitor. Provide the monitor ID and the fields to update (name, query, message, options, tags, etc.).';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'monitor_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the monitor to update.'],
            'type' => ['type' => 'string', 'description' => 'Updated monitor type.'],
            'query' => ['type' => 'string', 'description' => 'Updated monitor query.'],
            'name' => ['type' => 'string', 'description' => 'Updated display name.'],
            'message' => ['type' => 'string', 'description' => 'Updated notification message.'],
            'priority' => ['type' => 'integer', 'description' => 'Updated priority level (1-5).'],
            'options' => ['type' => 'object', 'description' => 'JSON-encoded monitor options (thresholds, notify_no_data, etc.).'],
            'tags' => ['type' => 'array', 'description' => 'Updated list of tags.'],
        ];
    }

    /**
     * Execute the tool and update the monitor.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Datadog integration is not configured.');
            }

            $monitorId = (int) $args['monitor_id'];
            $body = [];

            if (isset($args['type'])) {
                $body['type'] = $args['type'];
            }

            if (isset($args['query'])) {
                $body['query'] = $args['query'];
            }

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

            $result = $this->service->updateMonitor($monitorId, $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
