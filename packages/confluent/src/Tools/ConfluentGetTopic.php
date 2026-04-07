<?php

namespace OpenCompany\Integrations\Confluent\Tools;

use OpenCompany\Integrations\Confluent\ConfluentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Kafka topic.
 *
 * Returns the full topic configuration including partitions, replication, and settings.
 */
class ConfluentGetTopic implements Tool
{
    /**
     * Create a new ConfluentGetTopic tool instance.
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
        return 'confluent_get_topic';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get full details of a specific Kafka topic by name. Returns partition count, replication factor, and topic configuration.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'topic_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the topic to retrieve.'],
            'cluster_id' => ['type' => 'string', 'description' => 'Override the default Kafka cluster ID.'],
        ];
    }

    /**
     * Execute the tool and return the topic details.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Confluent integration is not configured.');
            }

            $topicName = $args['topic_name'];
            $clusterId = $args['cluster_id'] ?? null;
            $result = $this->service->getTopic($topicName, $clusterId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
