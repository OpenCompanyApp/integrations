<?php

namespace OpenCompany\Integrations\Render2\Tools;

use OpenCompany\Integrations\Render2\RenderService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RenderGetDeploy implements Tool
{
    public function __construct(
        private RenderService $service,
    ) {}

    public function name(): string
    {
        return 'render_get_deploy';
    }

    public function description(): string
    {
        return 'Get details for a specific Render deploy by ID. Returns full deploy information including status, commit, and logs.';
    }

    public function parameters(): array
    {
        return [
            'deploy_id' => ['type' => 'string', 'required' => true, 'description' => 'The deploy ID (e.g., "dep-cabc12345678").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Render integration is not configured.');
            }

            $result = $this->service->getDeploy($args['deploy_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
