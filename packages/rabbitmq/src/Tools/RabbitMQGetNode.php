<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Get RabbitMQ node details.
 *
 * Retrieves metrics and runtime details for one cluster node.
 */
class RabbitMQGetNode implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_get_node';
    }

    public function description(): string
    {
        return 'Get details for a RabbitMQ cluster node.';
    }

    public function parameters(): array
    {
        return ['name' => ['type' => 'string', 'required' => true, 'description' => 'RabbitMQ node name.']];
    }

    /**
     * Get node details.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->getNode((string) ($args['name'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
