<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Delete RabbitMQ user permissions.
 *
 * Removes permissions for one user on one virtual host.
 */
class RabbitMQDeletePermissions implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_delete_permissions';
    }

    public function description(): string
    {
        return 'Delete RabbitMQ permissions for a user on a virtual host.';
    }

    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'user' => ['type' => 'string', 'required' => true, 'description' => 'RabbitMQ username.'],
        ];
    }

    /**
     * Delete permissions.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->deletePermissions((string) ($args['vhost'] ?? '/'), (string) ($args['user'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
