<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * List RabbitMQ cluster nodes.
 *
 * Returns node metrics and runtime details from the management API.
 */
class RabbitMQListNodes implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_list_nodes';
    }

    public function description(): string
    {
        return 'List RabbitMQ cluster nodes with runtime and resource metrics.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List nodes.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->listNodes());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
