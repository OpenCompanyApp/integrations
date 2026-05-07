<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Run a RabbitMQ vhost aliveness test.
 *
 * Publishes and consumes a test message through the target virtual host.
 */
class RabbitMQAlivenessTest implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_aliveness_test';
    }

    public function description(): string
    {
        return 'Run RabbitMQ aliveness test for a virtual host.';
    }

    public function parameters(): array
    {
        return ['vhost' => ['type' => 'string', 'description' => 'Virtual host name. Defaults to /.']];
    }

    /**
     * Run aliveness test.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->alivenessTest((string) ($args['vhost'] ?? '/')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
