<?php

namespace OpenCompany\Integrations\Grafana\Tools;

use OpenCompany\Integrations\Grafana\GrafanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create or update a Grafana dashboard.
 *
 * Accepts a full dashboard JSON definition and creates it in the specified folder.
 * Set overwrite to true to update an existing dashboard.
 */
class GrafanaCreateDashboard implements Tool
{
    /**
     * Create a new GrafanaCreateDashboard tool instance.
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
        return 'grafana_create_dashboard';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Create or update a Grafana dashboard. Provide the full dashboard JSON with panels, queries, and settings. Set overwrite to true to update an existing dashboard.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'dashboard' => ['type' => 'object', 'required' => true, 'description' => 'The complete dashboard JSON object. Must include "title" at minimum.'],
            'folderUid' => ['type' => 'string', 'description' => 'UID of the folder to place the dashboard in.'],
            'overwrite' => ['type' => 'boolean', 'description' => 'Whether to overwrite an existing dashboard with the same slug (default: false).'],
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

            $dashboard = $args['dashboard'] ?? [];
            if (empty($dashboard)) {
                return ToolResult::error('Dashboard definition is required.');
            }

            if (!isset($dashboard['title'])) {
                return ToolResult::error('Dashboard must include a "title" field.');
            }

            $folderUid = $args['folderUid'] ?? '';
            $overwrite = $args['overwrite'] ?? false;

            $result = $this->service->createDashboard($dashboard, $folderUid, (bool) $overwrite);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
