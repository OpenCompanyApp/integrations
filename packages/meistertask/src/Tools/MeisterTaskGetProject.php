<?php

namespace OpenCompany\Integrations\MeisterTask\Tools;

use OpenCompany\Integrations\MeisterTask\MeisterTaskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MeisterTaskGetProject implements Tool
{
    public function __construct(
        private MeisterTaskService $service,
    ) {}

    public function name(): string
    {
        return 'meistertask_get_project';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific MeisterTask project, including sections, members, and status.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MeisterTask integration is not configured.');
            }

            $result = $this->service->getProject((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
