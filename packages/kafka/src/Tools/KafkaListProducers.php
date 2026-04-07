<?php

namespace OpenCompany\Integrations\Kafka\Tools;

use OpenCompany\Integrations\Kafka\KafkaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list producers for a specific Kafka topic.
 *
 * Returns producer IDs, client IDs, and connection details.
 */
class KafkaListProducers implements Tool
{
    /**
     * Create a new KafkaListProducers tool instance.
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
        return 'kafka_list_producers';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List producers for a specific Kafka topic. Returns producer IDs, client IDs, and connection details.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'topic_name' => ['type' => 'string', 'required' => true, 'description' => 'The topic name to list producers for.'],
            'cluster_id' => ['type' => 'string', 'description' => 'Override the default Kafka cluster ID.'],
        ];
    }

    /**
     * Execute the tool and return the list of producers.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kafka integration is not configured.');
            }

            $topicName = $args['topic_name'];
            $clusterId = $args['cluster_id'] ?? null;
            $result = $this->service->listProducers($topicName, $clusterId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
