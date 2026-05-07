<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;

/**
 * Export RabbitMQ definitions.
 *
 * Returns the broker definitions document.
 */
class RabbitMQExportDefinitions implements Tool
{
    /**
     * @param  RabbitMQService  $service  RabbitMQ Management API client
     */
    public function __construct(private RabbitMQService $service) {}

    public function name(): string
    {
        return 'rabbitmq_export_definitions';
    }

    public function description(): string
    {
        return 'Export RabbitMQ broker definitions.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Export definitions.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            return ToolResult::success($this->service->exportDefinitions());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
