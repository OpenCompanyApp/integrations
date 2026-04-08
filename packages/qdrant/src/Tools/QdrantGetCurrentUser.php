<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\Integrations\Qdrant\QdrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QdrantGetCurrentUser implements Tool
{
    public function __construct(
        private QdrantService $service,
    ) {}

    public function name(): string
    {
        return 'qdrant_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the Qdrant cluster, including cluster status, node information, and the authenticated user context.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
