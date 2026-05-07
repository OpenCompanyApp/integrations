<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Get messages from a RabbitMQ queue.
 *
 * Uses RabbitMQ's queue get endpoint, which can acknowledge or requeue messages depending on ackmode.
 */
class RabbitMQGetMessages implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_get_messages';
    }

    public function description(): string
    {
        return 'Get messages from a RabbitMQ queue using the management API. ackmode controls whether messages are requeued.';
    }

    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Queue name.'],
            'options' => ['type' => 'object', 'description' => 'Options: count, ackmode, encoding, truncate. Defaults to safe requeue mode.'],
        ];
    }

    /**
     * Get messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->getMessages((string) ($args['vhost'] ?? '/'), (string) ($args['name'] ?? ''), $args['options'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
