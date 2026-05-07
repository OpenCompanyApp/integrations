<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Import RabbitMQ definitions.
 *
 * Posts a definitions document to the broker.
 */
class RabbitMQImportDefinitions implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_import_definitions';
    }

    public function description(): string
    {
        return 'Import RabbitMQ broker definitions.';
    }

    public function parameters(): array
    {
        return ['definitions' => ['type' => 'object', 'required' => true, 'description' => 'RabbitMQ definitions document.']];
    }

    /**
     * Import definitions.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->importDefinitions($args['definitions'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
