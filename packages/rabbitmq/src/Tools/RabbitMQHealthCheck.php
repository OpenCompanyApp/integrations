<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Run a RabbitMQ health check.
 *
 * Calls one of RabbitMQ's documented /api/health/checks endpoints.
 */
class RabbitMQHealthCheck implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_health_check';
    }

    public function description(): string
    {
        return 'Run a RabbitMQ management health check such as alarms, local-alarms, virtual-hosts, port-listener, or protocol-listener.';
    }

    public function parameters(): array
    {
        return [
            'check' => ['type' => 'string', 'required' => true, 'description' => 'Health check name.'],
            'params' => ['type' => 'object', 'description' => 'Optional query parameters such as port, protocol, or timeout.'],
        ];
    }

    /**
     * Run health check.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->healthCheck((string) ($args['check'] ?? ''), $args['params'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
