<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Get Qdrant cluster information.
 */
class QdrantGetClusterInfo implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_get_cluster_info';
    }

    public function description(): string
    {
        return 'Get Qdrant cluster information, including peer state and cluster status where available.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get cluster information.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            return ToolResult::success($this->service->getClusterInfo());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
