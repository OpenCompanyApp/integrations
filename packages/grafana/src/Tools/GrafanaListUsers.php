<?php

namespace OpenCompany\Integrations\Grafana\Tools;

use OpenCompany\Integrations\Grafana\GrafanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list organization users in Grafana with pagination.
 *
 * Returns user IDs, names, emails, and roles.
 */
class GrafanaListUsers implements Tool
{
    /**
     * Create a new GrafanaListUsers tool instance.
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
        return 'grafana_list_users';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'List users in the Grafana organization. Returns user IDs, names, emails, and roles with pagination.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of users per page (default: 50).'],
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
            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;

            $result = $this->service->listUsers($page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
