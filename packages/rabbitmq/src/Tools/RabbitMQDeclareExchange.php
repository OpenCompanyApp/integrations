<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Declare or update a RabbitMQ exchange.
 *
 * Uses the Management API exchange declaration endpoint.
 */
class RabbitMQDeclareExchange implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_declare_exchange';
    }

    public function description(): string
    {
        return 'Declare or update a RabbitMQ exchange.';
    }

    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Exchange name.'],
            'definition' => ['type' => 'object', 'required' => true, 'description' => 'Exchange definition: type, durable, auto_delete, internal, arguments.'],
        ];
    }

    /**
     * Declare exchange.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->declareExchange((string) ($args['vhost'] ?? '/'), (string) ($args['name'] ?? ''), $args['definition'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
