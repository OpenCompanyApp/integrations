<?php

namespace OpenCompany\Integrations\Confluent\Tools;

use OpenCompany\Integrations\Confluent\ConfluentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new Kafka topic in a Confluent cluster.
 *
 * Supports specifying topic name, partition count, replication factor, and configuration.
 */
class ConfluentCreateTopic implements Tool
{
    /**
     * Create a new ConfluentCreateTopic tool instance.
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
        return 'confluent_create_topic';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new Kafka topic in a Confluent cluster. Specify the topic name, partition count, and optional replication factor and configs.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'topic_name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the new topic.'],
            'partitions_count' => ['type' => 'integer', 'required' => true, 'description' => 'Number of partitions for the topic (e.g., 6).'],
            'replication_factor' => ['type' => 'integer', 'description' => 'Replication factor (e.g., 3 for production). Defaults to the cluster default.'],
            'configs' => ['type' => 'object', 'description' => 'JSON-encoded topic configs: retention.ms, cleanup.policy, etc.'],
            'cluster_id' => ['type' => 'string', 'description' => 'Override the default Kafka cluster ID.'],
        ];
    }

    /**
     * Execute the tool and create the topic.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Confluent integration is not configured.');
            }

            $body = [
                'topic_name' => $args['topic_name'],
                'partitions_count' => (int) $args['partitions_count'],
            ];

            if (isset($args['replication_factor'])) {
                $body['replication_factor'] = (int) $args['replication_factor'];
            }

            if (isset($args['configs'])) {
                $configs = $args['configs'];
                $body['configs'] = is_string($configs) ? json_decode($configs, true) : $configs;
            }

            $clusterId = $args['cluster_id'] ?? null;
            $result = $this->service->createTopic($body, $clusterId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
