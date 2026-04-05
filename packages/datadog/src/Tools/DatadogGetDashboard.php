<?php

namespace OpenCompany\Integrations\Datadog\Tools;

use OpenCompany\Integrations\Datadog\DatadogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Datadog dashboard.
 *
 * Returns the full dashboard definition including widgets, layout, and variables.
 */
class DatadogGetDashboard implements Tool
{
    /**
     * Create a new DatadogGetDashboard tool instance.
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
        return 'datadog_get_dashboard';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get full details of a specific Datadog dashboard by ID. Returns the dashboard layout, widgets, and template variables.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'dashboard_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the dashboard to retrieve.'],
        ];
    }

    /**
     * Execute the tool and return the dashboard details.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Datadog integration is not configured.');
            }

            $result = $this->service->getDashboard($args['dashboard_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
