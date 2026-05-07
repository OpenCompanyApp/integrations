<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Delete a RabbitMQ virtual host.
 *
 * Removes the specified virtual host if the server allows deletion.
 */
class RabbitMQDeleteVhost implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_delete_vhost';
    }

    public function description(): string
    {
        return 'Delete a RabbitMQ virtual host.';
    }

    public function parameters(): array
    {
        return ['name' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.']];
    }

    /**
     * Delete vhost.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->deleteVhost((string) ($args['name'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
