<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Get RabbitMQ user details.
 *
 * Retrieves one internal RabbitMQ user by username.
 */
class RabbitMQGetUser implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_get_user';
    }

    public function description(): string
    {
        return 'Get details for one RabbitMQ user.';
    }

    public function parameters(): array
    {
        return ['name' => ['type' => 'string', 'required' => true, 'description' => 'RabbitMQ username.']];
    }

    /**
     * Get user.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->getUser((string) ($args['name'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
