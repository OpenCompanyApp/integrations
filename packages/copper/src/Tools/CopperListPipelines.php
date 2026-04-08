<?php

namespace OpenCompany\Integrations\Copper\Tools;

use OpenCompany\Integrations\Copper\CopperService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CopperListPipelines implements Tool
{
    public function __construct(
        private CopperService $service,
    ) {}

    public function name(): string
    {
        return 'copper_list_pipelines';
    }

    public function description(): string
    {
        return 'List all sales pipelines in Copper CRM. Each pipeline contains stages that opportunities move through.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Copper integration is not configured.');
            }

            $result = $this->service->listPipelines();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
