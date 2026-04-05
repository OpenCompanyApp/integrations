<?php

namespace OpenCompany\Integrations\Harvest\Tools;

use OpenCompany\Integrations\Harvest\HarvestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Harvest projects with optional filters.
 *
 * Supports filtering by client and active status. Paginated
 * via page/per_page.
 */
class HarvestListProjects implements Tool
{
    /**
     * @param  HarvestService  $service  The Harvest API client
     */
    public function __construct(
        private HarvestService $service,
    ) {}

    public function name(): string
    {
        return 'harvest_list_projects';
    }

    public function description(): string
    {
        return 'List Harvest projects with optional filters for client and active status.';
    }

    public function parameters(): array
    {
        return [
            'client_id' => ['type' => 'integer',  'description' => 'Filter by client ID.'],
            'is_active' => ['type' => 'boolean',  'description' => 'Filter to active projects only.'],
            'page'      => ['type' => 'integer',  'description' => 'Page number (default: 1).'],
            'per_page'  => ['type' => 'integer',  'description' => 'Results per page (default: 100).'],
        ];
    }

    /**
     * List projects with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (client_id, is_active, page, per_page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Harvest integration is not configured.');
            }

            $params = [];

            foreach (['client_id', 'is_active', 'page', 'per_page'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listProjects($params);

            return ToolResult::success([
                'projects'  => $result['projects'] ?? [],
                'pagination' => $result['_pagination'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
