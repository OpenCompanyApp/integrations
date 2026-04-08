<?php

namespace OpenCompany\Integrations\Datadog\Tools;

use OpenCompany\Integrations\Datadog\DatadogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Datadog monitor.
 *
 * Returns the full monitor definition including query, thresholds, and state.
 */
class DatadogGetMonitor implements Tool
{
    /**
     * Create a new DatadogGetMonitor tool instance.
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
        return 'datadog_get_monitor';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get full details of a specific Datadog monitor by ID. Returns the monitor query, thresholds, message, and current state.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'monitor_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the monitor to retrieve.'],
        ];
    }

    /**
     * Execute the tool and return the monitor details.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Datadog integration is not configured.');
            }

            $result = $this->service->getMonitor((int) $args['monitor_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
