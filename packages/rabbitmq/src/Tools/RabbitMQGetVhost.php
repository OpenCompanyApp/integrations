<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Get RabbitMQ virtual host details.
 *
 * Retrieves metrics and metadata for one vhost.
 */
class RabbitMQGetVhost implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_get_vhost';
    }

    public function description(): string
    {
        return 'Get details for one RabbitMQ virtual host.';
    }

    public function parameters(): array
    {
        return ['name' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.']];
    }

    /**
     * Get vhost.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->getVhost((string) ($args['name'] ?? '/')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
