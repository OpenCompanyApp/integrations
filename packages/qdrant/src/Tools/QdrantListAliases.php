<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * List Qdrant collection aliases.
 */
class QdrantListAliases implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_list_aliases';
    }

    public function description(): string
    {
        return 'List all Qdrant collection aliases in the cluster.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List aliases.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            return ToolResult::success($this->service->listAliases());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
