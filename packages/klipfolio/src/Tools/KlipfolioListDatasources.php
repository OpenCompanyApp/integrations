<?php

namespace OpenCompany\Integrations\Klipfolio\Tools;

use OpenCompany\Integrations\Klipfolio\KlipfolioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all data sources accessible to the authenticated Klipfolio user.
 *
 * Returns a paginated list of data sources including their IDs, names,
 * connector types, and other metadata.
 */
class KlipfolioListDatasources implements Tool
{
    public function __construct(
        private KlipfolioService $service,
    ) {}

    public function name(): string
    {
        return 'klipfolio_list_datasources';
    }

    public function description(): string
    {
        return 'List all data sources accessible to the authenticated user in Klipfolio. Returns data source IDs, names, and connector types.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of data sources to return per page (default: 25).'],
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

            $result = $this->service->listDatasources($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
