<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Declare or update a RabbitMQ queue.
 *
 * Uses RabbitMQ's PUT queue endpoint with a queue definition payload.
 */
class RabbitMQDeclareQueue implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_declare_queue';
    }

    public function description(): string
    {
        return 'Declare or update a RabbitMQ queue.';
    }

    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Queue name.'],
            'definition' => ['type' => 'object', 'description' => 'Queue definition: durable, auto_delete, arguments, node.'],
        ];
    }

    /**
     * Declare queue.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->declareQueue((string) ($args['vhost'] ?? '/'), (string) ($args['name'] ?? ''), $args['definition'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
