<?php

namespace OpenCompany\Integrations\Datadog\Tools;

use OpenCompany\Integrations\Datadog\DatadogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to delete a Datadog monitor.
 *
 * Permanently removes the monitor and its configuration.
 */
class DatadogDeleteMonitor implements Tool
{
    /**
     * Create a new DatadogDeleteMonitor tool instance.
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
        return 'datadog_delete_monitor';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Delete a Datadog monitor by ID. This action is permanent and cannot be undone.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'monitor_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the monitor to delete.'],
        ];
    }

    /**
     * Execute the tool and delete the monitor.
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
            $this->service->deleteMonitor($monitorId);

            return ToolResult::success("Monitor {$monitorId} has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
