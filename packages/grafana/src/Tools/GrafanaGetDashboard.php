<?php

namespace OpenCompany\Integrations\Grafana\Tools;

use OpenCompany\Integrations\Grafana\GrafanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve a single Grafana dashboard by its UID.
 *
 * Returns the full dashboard JSON including panels, templating, and annotations.
 */
class GrafanaGetDashboard implements Tool
{
    /**
     * Create a new GrafanaGetDashboard tool instance.
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
        return 'grafana_get_dashboard';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get a Grafana dashboard by its UID. Returns the full dashboard definition including panels, queries, and settings.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'uid' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier (UID) of the dashboard.'],
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

            $uid = $args['uid'] ?? '';
            if (empty($uid)) {
                return ToolResult::error('Dashboard UID is required.');
            }

            $result = $this->service->getDashboard($uid);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
