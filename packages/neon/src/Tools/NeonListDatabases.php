<?php

namespace OpenCompany\Integrations\Neon\Tools;

use OpenCompany\Integrations\Neon\NeonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NeonListDatabases implements Tool
{
    public function __construct(
        private NeonService $service,
    ) {}

    public function name(): string
    {
        return 'neon_list_databases';
    }

    public function description(): string
    {
        return 'List all databases in a Neon project branch. Returns database names, owners, and sizes.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID.'],
            'branch_id' => ['type' => 'string', 'required' => true, 'description' => 'The branch ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Neon integration is not configured.');
            }

            $result = $this->service->listDatabases($args['project_id'], $args['branch_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
