<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * List RabbitMQ users.
 *
 * Returns users known to the RabbitMQ internal user database.
 */
class RabbitMQListUsers implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_list_users';
    }

    public function description(): string
    {
        return 'List RabbitMQ users.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List users.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->listUsers());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
