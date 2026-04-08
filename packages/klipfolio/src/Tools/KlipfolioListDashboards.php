<?php

namespace OpenCompany\Integrations\Klipfolio\Tools;

use OpenCompany\Integrations\Klipfolio\KlipfolioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all dashboards accessible to the authenticated Klipfolio user.
 *
 * Returns a paginated list of dashboards including their IDs, names,
 * descriptions, and other metadata.
 */
class KlipfolioListDashboards implements Tool
{
    public function __construct(
        private KlipfolioService $service,
    ) {}

    public function name(): string
    {
        return 'klipfolio_list_dashboards';
    }

    public function description(): string
    {
        return 'List all dashboards accessible to the authenticated user in Klipfolio. Returns dashboard IDs, names, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of dashboards to return per page (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination, 1-based (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Klipfolio integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listDashboards($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
