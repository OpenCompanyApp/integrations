<?php

namespace OpenCompany\Integrations\Grafana\Tools;

use OpenCompany\Integrations\Grafana\GrafanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Grafana alerts with optional filtering.
 *
 * Returns alert IDs, states, dashboard/panel references, and conditions.
 */
class GrafanaListAlerts implements Tool
{
    /**
     * Create a new GrafanaListAlerts tool instance.
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
        return 'grafana_list_alerts';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List Grafana alerts. Optionally filter by dashboard ID or panel ID. Returns alert states, thresholds, and conditions.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'dashboardId' => ['type' => 'integer', 'description' => 'Filter alerts by dashboard ID.'],
            'panelId' => ['type' => 'integer', 'description' => 'Filter alerts by panel ID.'],
        ];
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

            $dashboardId = isset($args['dashboardId']) ? (int) $args['dashboardId'] : null;
            $panelId = isset($args['panelId']) ? (int) $args['panelId'] : null;

            $result = $this->service->listAlerts($dashboardId, $panelId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
