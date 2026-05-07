<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Set RabbitMQ user permissions.
 *
 * Assigns configure, write, and read regex permissions for one user and vhost.
 */
class RabbitMQSetPermissions implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_set_permissions';
    }

    public function description(): string
    {
        return 'Set RabbitMQ configure, write, and read permissions for a user on a virtual host.';
    }

    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'user' => ['type' => 'string', 'required' => true, 'description' => 'RabbitMQ username.'],
            'configure' => ['type' => 'string', 'required' => true, 'description' => 'Configure regex.'],
            'write' => ['type' => 'string', 'required' => true, 'description' => 'Write regex.'],
            'read' => ['type' => 'string', 'required' => true, 'description' => 'Read regex.'],
        ];
    }

    /**
     * Set permissions.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->setPermissions(
                (string) ($args['vhost'] ?? '/'),
                (string) ($args['user'] ?? ''),
                (string) ($args['configure'] ?? ''),
                (string) ($args['write'] ?? ''),
                (string) ($args['read'] ?? ''),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
