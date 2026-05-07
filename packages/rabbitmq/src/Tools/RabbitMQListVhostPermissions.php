<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * List permissions for a RabbitMQ virtual host.
 *
 * Returns user permissions scoped to one vhost.
 */
class RabbitMQListVhostPermissions implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_list_vhost_permissions';
    }

    public function description(): string
    {
        return 'List RabbitMQ permissions for a virtual host.';
    }

    public function parameters(): array
    {
        return ['vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.']];
    }

    /**
     * List vhost permissions.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->listVhostPermissions((string) ($args['vhost'] ?? '/')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
