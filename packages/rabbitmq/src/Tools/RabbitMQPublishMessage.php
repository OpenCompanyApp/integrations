<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Publish a message to a RabbitMQ exchange.
 *
 * Uses the Management API publish endpoint for operational/manual publishes.
 */
class RabbitMQPublishMessage implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_publish_message';
    }

    public function description(): string
    {
        return 'Publish a message to a RabbitMQ exchange through the management API.';
    }

    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'exchange' => ['type' => 'string', 'required' => true, 'description' => 'Exchange name. Use empty string for default exchange.'],
            'message' => ['type' => 'object', 'required' => true, 'description' => 'Message payload: properties, routing_key, payload, payload_encoding.'],
        ];
    }

    /**
     * Publish message.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->publishMessage((string) ($args['vhost'] ?? '/'), (string) ($args['exchange'] ?? ''), $args['message'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
