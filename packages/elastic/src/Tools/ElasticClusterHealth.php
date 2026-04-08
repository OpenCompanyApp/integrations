<?php

namespace OpenCompany\Integrations\Elastic\Tools;

use OpenCompany\Integrations\Elastic\ElasticService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ElasticClusterHealth implements Tool
{
    /**
     * @param  ElasticService  $service  The Elasticsearch service instance
     */
    public function __construct(
        private ElasticService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'elastic_cluster_health';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get the health status of the Elasticsearch cluster, including status (green/yellow/red), number of nodes, and shard information.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args  The tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Elasticsearch integration is not configured.');
            }

            $result = $this->service->clusterHealth();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
