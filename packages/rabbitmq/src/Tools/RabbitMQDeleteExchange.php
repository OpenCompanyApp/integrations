<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Delete a RabbitMQ exchange.
 *
 * Supports RabbitMQ's if-unused conditional deletion flag.
 */
class RabbitMQDeleteExchange implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_delete_exchange';
    }

    public function description(): string
    {
        return 'Delete a RabbitMQ exchange, optionally only if unused.';
    }

    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Exchange name.'],
            'if_unused' => ['type' => 'boolean', 'description' => 'Only delete when the exchange is unused.'],
        ];
    }

    /**
     * Delete exchange.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->deleteExchange(
                (string) ($args['vhost'] ?? '/'),
                (string) ($args['name'] ?? ''),
                array_key_exists('if_unused', $args) ? (bool) $args['if_unused'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
