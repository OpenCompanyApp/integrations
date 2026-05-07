<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Close a RabbitMQ connection.
 *
 * Uses the management API connection delete endpoint with an optional X-Reason header.
 */
class RabbitMQCloseConnection implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_close_connection';
    }

    public function description(): string
    {
        return 'Close a RabbitMQ connection by name.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Connection name from RabbitMQ.'],
            'reason' => ['type' => 'string', 'description' => 'Optional close reason.'],
        ];
    }

    /**
     * Close connection.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->closeConnection((string) ($args['name'] ?? ''), isset($args['reason']) ? (string) $args['reason'] : null));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
