<?php

namespace OpenCompany\Integrations\Nifty\Tools;

use OpenCompany\Integrations\Nifty\NiftyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NiftyListProjects implements Tool
{
    public function __construct(
        private NiftyService $service,
    ) {}

    public function name(): string
    {
        return 'nifty_list_projects';
    }

    public function description(): string
    {
        return 'List all projects in Nifty. Returns project IDs, names, and metadata that can be used to query tasks.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of projects to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of projects to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Nifty integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listProjects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
