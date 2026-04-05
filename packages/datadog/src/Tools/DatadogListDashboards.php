<?php

namespace OpenCompany\Integrations\Datadog\Tools;

use OpenCompany\Integrations\Datadog\DatadogService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all Datadog dashboards.
 *
 * Returns a list of dashboards with their IDs, titles, and descriptions.
 */
class DatadogListDashboards implements Tool
{
    /**
     * Create a new DatadogListDashboards tool instance.
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
        return 'datadog_list_dashboards';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all Datadog dashboards. Returns dashboard IDs, titles, descriptions, and modification dates.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the list of dashboards.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Datadog integration is not configured.');
            }

            $result = $this->service->listDashboards();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
