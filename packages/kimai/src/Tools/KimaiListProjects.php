<?php

namespace OpenCompany\Integrations\Kimai\Tools;

use OpenCompany\Integrations\Kimai\KimaiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KimaiListProjects implements Tool
{
    public function __construct(
        private KimaiService $service,
    ) {}

    public function name(): string
    {
        return 'kimai_list_projects';
    }

    public function description(): string
    {
        return 'List projects from Kimai. Supports filtering by customer and visibility. Returns project details including name, customer, budget, and time budget information.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50).'],
            'customer' => ['type' => 'integer', 'description' => 'Filter by customer ID to list only projects for a specific customer.'],
            'visible' => ['type' => 'integer', 'description' => 'Visibility filter: 1 for visible projects only, 2 for hidden, 3 for all.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kimai integration is not configured.');
            }

            $params = [];

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['size'])) {
                $params['size'] = (int) $args['size'];
            }
            if (isset($args['customer'])) {
                $params['customer'] = (int) $args['customer'];
            }
            if (isset($args['visible'])) {
                $params['visible'] = (int) $args['visible'];
            }

            $result = $this->service->listProjects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
