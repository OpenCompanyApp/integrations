<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * List RabbitMQ permissions.
 *
 * Returns all user permissions across virtual hosts.
 */
class RabbitMQListPermissions implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_list_permissions';
    }

    public function description(): string
    {
        return 'List RabbitMQ permissions across all virtual hosts.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List permissions.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->listPermissions());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
