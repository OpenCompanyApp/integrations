<?php

namespace OpenCompany\Integrations\Confluent\Tools;

use OpenCompany\Integrations\Confluent\ConfluentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Kafka cluster.
 *
 * Returns cluster configuration including broker count, controller info, and settings.
 */
class ConfluentGetCluster implements Tool
{
    /**
     * Create a new ConfluentGetCluster tool instance.
     *
     * @param  ConfluentService  $service  The Confluent API service
     */
    public function __construct(
        private ConfluentService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'confluent_get_cluster';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get details of a specific Kafka cluster. Returns broker count, controller info, and cluster configuration.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'cluster_id' => ['type' => 'string', 'description' => 'The cluster ID to retrieve. Uses the default cluster if not specified.'],
        ];
    }

    /**
     * Execute the tool and return the cluster details.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Confluent integration is not configured.');
            }

            $clusterId = $args['cluster_id'] ?? null;
            $result = $this->service->getCluster($clusterId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
