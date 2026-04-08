<?php

namespace OpenCompany\Integrations\Milvus\Tools;

use OpenCompany\Integrations\Milvus\MilvusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MilvusGetHealth implements Tool
{
    public function __construct(
        private MilvusService $service,
    ) {}

    public function name(): string
    {
        return 'milvus_get_health';
    }

    public function description(): string
    {
        return 'Check the health status of the Milvus vector database server. Returns health and version information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Milvus integration is not configured.');
            }

            $result = $this->service->getHealth();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
