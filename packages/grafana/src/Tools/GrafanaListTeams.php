<?php

namespace OpenCompany\Integrations\Grafana\Tools;

use OpenCompany\Integrations\Grafana\GrafanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Grafana teams with pagination.
 *
 * Returns team IDs, names, emails, and member counts.
 */
class GrafanaListTeams implements Tool
{
    /**
     * Create a new GrafanaListTeams tool instance.
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
        return 'grafana_list_teams';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List all Grafana teams. Returns team IDs, names, emails, and member counts with pagination support.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'perPage' => ['type' => 'integer', 'description' => 'Number of teams per page (default: 50).'],
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

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['perPage']) ? (int) $args['perPage'] : 50;

            $result = $this->service->listTeams($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
