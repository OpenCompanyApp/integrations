<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Delete a RabbitMQ binding.
 *
 * Deletes one binding by its RabbitMQ properties key.
 */
class RabbitMQDeleteBinding implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_delete_binding';
    }

    public function description(): string
    {
        return 'Delete a RabbitMQ binding by properties key.';
    }

    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'Virtual host name.'],
            'source' => ['type' => 'string', 'required' => true, 'description' => 'Source exchange name.'],
            'destination_type' => ['type' => 'string', 'required' => true, 'description' => 'Destination type: queue or exchange.'],
            'destination' => ['type' => 'string', 'required' => true, 'description' => 'Destination queue or exchange name.'],
            'properties_key' => ['type' => 'string', 'required' => true, 'description' => 'Binding properties_key returned by RabbitMQ.'],
        ];
    }

    /**
     * Delete binding.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->deleteBinding(
                (string) ($args['vhost'] ?? '/'),
                (string) ($args['source'] ?? ''),
                (string) ($args['destination_type'] ?? 'queue'),
                (string) ($args['destination'] ?? ''),
                (string) ($args['properties_key'] ?? ''),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
