<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Delete a RabbitMQ queue.
 *
 * Supports RabbitMQ's conditional if-empty and if-unused flags.
 */
class RabbitMQDeleteQueue implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_delete_queue';
    }

    public function description(): string
    {
        return 'Delete a RabbitMQ queue, optionally only if empty or unused.';
    }

    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Queue name.'],
            'if_empty' => ['type' => 'boolean', 'description' => 'Only delete when the queue is empty.'],
            'if_unused' => ['type' => 'boolean', 'description' => 'Only delete when the queue is unused.'],
        ];
    }

    /**
     * Delete queue.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->deleteQueue(
                (string) ($args['vhost'] ?? '/'),
                (string) ($args['name'] ?? ''),
                array_key_exists('if_empty', $args) ? (bool) $args['if_empty'] : null,
                array_key_exists('if_unused', $args) ? (bool) $args['if_unused'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
