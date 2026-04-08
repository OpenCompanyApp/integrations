<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\Integrations\RabbitMQ\RabbitMQService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: list all RabbitMQ virtual hosts.
 *
 * Calls <code>GET /api/vhosts</code> on the RabbitMQ Management API and
 * returns a list of virtual hosts with their metadata.
 */
class RabbitMQListVhosts implements Tool
{
    /**
     * @param RabbitMQService $service Injected RabbitMQ management service.
     */
    public function __construct(
        private RabbitMQService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'rabbitmq_list_vhosts';
    }

    /**
     * Human-readable description presented to the AI agent.
     */
    public function description(): string
    {
        return 'List all RabbitMQ virtual hosts. Returns vhost names, tracing status, and message counts.';
    }

    /**
     * Input parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool call.
     *
     * @param array<string, mixed> $args Tool arguments (none required).
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            $vhosts = $this->service->listVhosts();

            return ToolResult::success($this->formatVhosts($vhosts));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Summarise raw vhost data for the agent response.
     *
     * @param array<int, array<string, mixed>> $vhosts Raw API response.
     * @return array{vhosts: array<int, array<string, mixed>>, total: int}
     */
    private function formatVhosts(array $vhosts): array
    {
        $summarised = array_map(function (array $v): array {
            return [
                'name'     => $v['name'] ?? '/',
                'tracing'  => $v['tracing'] ?? false,
                'messages' => $v['messages'] ?? 0,
                'messages_ready' => $v['messages_ready'] ?? 0,
                'messages_unacknowledged' => $v['messages_unacknowledged'] ?? 0,
            ];
        }, $vhosts);

        return [
            'vhosts' => $summarised,
            'total'  => count($summarised),
        ];
    }
}
