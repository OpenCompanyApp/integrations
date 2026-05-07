<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * List RabbitMQ consumers.
 *
 * Returns consumers globally or scoped to a virtual host.
 */
class RabbitMQListConsumers implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_list_consumers';
    }

    public function description(): string
    {
        return 'List RabbitMQ consumers globally or for a virtual host.';
    }

    public function parameters(): array
    {
        return ['vhost' => ['type' => 'string', 'description' => 'Optional virtual host name.']];
    }

    /**
     * List consumers.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->listConsumers(isset($args['vhost']) ? (string) $args['vhost'] : null));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
