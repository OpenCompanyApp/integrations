<?php

namespace OpenCompany\Integrations\Harvest\Tools;

use OpenCompany\Integrations\Harvest\HarvestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Harvest clients with optional filters.
 *
 * Supports filtering by active status. Paginated via page.
 */
class HarvestListClients implements Tool
{
    /**
     * @param  HarvestService  $service  The Harvest API client
     */
    public function __construct(
        private HarvestService $service,
    ) {}

    public function name(): string
    {
        return 'harvest_list_clients';
    }

    public function description(): string
    {
        return 'List Harvest clients with optional active status filter.';
    }

    public function parameters(): array
    {
        return [
            'is_active' => ['type' => 'boolean', 'description' => 'Filter to active clients only.'],
            'page'      => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
        ];
    }

    /**
     * List clients with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (is_active, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Harvest integration is not configured.');
            }

            $params = [];

            foreach (['is_active', 'page'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listClients($params);

            return ToolResult::success([
                'clients'    => $result['clients'] ?? [],
                'pagination' => $result['_pagination'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
