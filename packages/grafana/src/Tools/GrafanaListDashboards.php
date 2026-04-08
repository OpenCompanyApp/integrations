<?php

namespace OpenCompany\Integrations\Grafana\Tools;

use OpenCompany\Integrations\Grafana\GrafanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to search and list Grafana dashboards.
 *
 * Returns a list of dashboards matching the given query and type filters.
 */
class GrafanaListDashboards implements Tool
{
    /**
     * Create a new GrafanaListDashboards tool instance.
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
        return 'grafana_list_dashboards';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Search and list Grafana dashboards. Returns dashboard UIDs, titles, and folder info. Use query to filter by title.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'description' => 'Search query to filter dashboards by title.'],
            'type' => ['type' => 'string', 'description' => 'Dashboard type filter. Default: "dash-db" (saved dashboards).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return (default: 100).'],
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

            $query = $args['query'] ?? null;
            $type = $args['type'] ?? 'dash-db';
            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;

            $result = $this->service->listDashboards($query, $type, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
