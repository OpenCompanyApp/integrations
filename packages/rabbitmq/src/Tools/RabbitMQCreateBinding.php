<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Create a RabbitMQ binding.
 *
 * Binds a source exchange to a queue or destination exchange.
 */
class RabbitMQCreateBinding implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_create_binding';
    }

    public function description(): string
    {
        return 'Create a RabbitMQ binding from an exchange to a queue or exchange.';
    }

    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'source' => ['type' => 'string', 'required' => true, 'description' => 'Source exchange name.'],
            'destination_type' => ['type' => 'string', 'required' => true, 'description' => 'Destination type: queue or exchange.'],
            'destination' => ['type' => 'string', 'required' => true, 'description' => 'Destination queue or exchange name.'],
            'routing_key' => ['type' => 'string', 'description' => 'Binding routing key.'],
            'arguments' => ['type' => 'object', 'description' => 'Binding arguments.'],
        ];
    }

    /**
     * Create binding.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->createBinding(
                (string) ($args['vhost'] ?? '/'),
                (string) ($args['source'] ?? ''),
                (string) ($args['destination_type'] ?? 'queue'),
                (string) ($args['destination'] ?? ''),
                (string) ($args['routing_key'] ?? ''),
                $args['arguments'] ?? [],
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
