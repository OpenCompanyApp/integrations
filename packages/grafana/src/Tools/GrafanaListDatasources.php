<?php

namespace OpenCompany\Integrations\Grafana\Tools;

use OpenCompany\Integrations\Grafana\GrafanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all configured Grafana datasources.
 *
 * Returns datasource IDs, names, types, and access configuration.
 */
class GrafanaListDatasources implements Tool
{
    /**
     * Create a new GrafanaListDatasources tool instance.
     *
     * @param GrafanaService $service The Grafana API service.
     */
    public function __construct(
        private GrafanaService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'grafana_list_datasources';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List all configured datasources in Grafana. Returns datasource IDs, names, types (e.g., Prometheus, InfluxDB), and access info.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Grafana integration is not configured.');
            }

            $result = $this->service->listDatasources();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
