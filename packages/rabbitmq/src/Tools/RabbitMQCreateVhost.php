<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Create or update a RabbitMQ virtual host.
 *
 * Supports documented vhost metadata such as description, tags, tracing, and default queue type.
 */
class RabbitMQCreateVhost implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_create_vhost';
    }

    public function description(): string
    {
        return 'Create or update a RabbitMQ virtual host.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'metadata' => ['type' => 'object', 'description' => 'Optional metadata: description, tags, default_queue_type, protected_from_deletion, tracing.'],
        ];
    }

    /**
     * Create vhost.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->createVhost((string) ($args['name'] ?? ''), $args['metadata'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
