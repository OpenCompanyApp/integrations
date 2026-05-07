<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * List bindings where an exchange is the destination.
 *
 * Uses RabbitMQ's exchange destination bindings endpoint.
 */
class RabbitMQListExchangeDestinationBindings implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_list_exchange_destination_bindings';
    }

    public function description(): string
    {
        return 'List bindings where a RabbitMQ exchange is the destination.';
    }

    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Exchange name.'],
        ];
    }

    /**
     * List destination bindings.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->listExchangeDestinationBindings((string) ($args['vhost'] ?? '/'), (string) ($args['name'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
