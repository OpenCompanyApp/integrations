<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * List RabbitMQ channels.
 *
 * Returns open AMQP channels across active connections.
 */
class RabbitMQListChannels implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_list_channels';
    }

    public function description(): string
    {
        return 'List RabbitMQ channels.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List channels.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->listChannels());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
