<?php

namespace OpenCompany\Integrations\Kafka\Tools;

use OpenCompany\Integrations\Kafka\KafkaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Kafka clusters in Confluent Cloud.
 *
 * Returns cluster IDs, names, types, and status.
 */
class KafkaListClusters implements Tool
{
    /**
     * Create a new KafkaListClusters tool instance.
     *
     * @param  KafkaService  $service  The Kafka API service
     */
    public function __construct(
        private KafkaService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'kafka_list_clusters';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List Kafka clusters in your Confluent Cloud environment. Returns cluster IDs, names, types, and status.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the list of clusters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kafka integration is not configured.');
            }

            $result = $this->service->listClusters();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
