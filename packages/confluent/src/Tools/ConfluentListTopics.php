<?php

namespace OpenCompany\Integrations\Confluent\Tools;

use OpenCompany\Integrations\Confluent\ConfluentService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Kafka topics in a Confluent cluster.
 *
 * Returns topic names, partition counts, replication factors, and configuration.
 */
class ConfluentListTopics implements Tool
{
    /**
     * Create a new ConfluentListTopics tool instance.
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
        return 'confluent_list_topics';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List Kafka topics in a Confluent cluster. Returns topic names, partition counts, replication factors, and status.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'cluster_id' => ['type' => 'string', 'description' => 'Override the default Kafka cluster ID.'],
        ];
    }

    /**
     * Execute the tool and return the list of topics.
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
            $result = $this->service->listTopics($clusterId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
