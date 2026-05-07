<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * List bindings for a RabbitMQ queue.
 *
 * Returns all bindings attached to a specific queue.
 */
class RabbitMQGetQueueBindings implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_get_queue_bindings';
    }

    public function description(): string
    {
        return 'List RabbitMQ bindings for a specific queue.';
    }

    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Queue name.'],
        ];
    }

    /**
     * Get queue bindings.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->getQueueBindings((string) ($args['vhost'] ?? '/'), (string) ($args['name'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
