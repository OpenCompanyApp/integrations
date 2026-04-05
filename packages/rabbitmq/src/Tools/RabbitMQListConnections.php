<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\Integrations\RabbitMQ\RabbitMQService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: list all RabbitMQ connections.
 *
 * Calls <code>GET /api/connections</code> on the RabbitMQ Management API and
 * returns a summarised list of every active AMQP connection.
 */
class RabbitMQListConnections implements Tool
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
        return 'rabbitmq_list_connections';
    }

    /**
     * Human-readable description presented to the AI agent.
     */
    public function description(): string
    {
        return 'List all active RabbitMQ AMQP connections. Returns client info, peer host/port, channels, and connection state.';
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

            $connections = $this->service->listConnections();

            return ToolResult::success($this->formatConnections($connections));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Summarise raw connection data for the agent response.
     *
     * @param array<int, array<string, mixed>> $connections Raw API response.
     * @return array{connections: array<int, array<string, mixed>>, total: int}
     */
    private function formatConnections(array $connections): array
    {
        $summarised = array_map(function (array $c): array {
            return [
                'name'      => $c['name'] ?? '',
                'user'      => $c['user'] ?? '',
                'vhost'     => $c['vhost'] ?? '/',
                'state'     => $c['state'] ?? 'unknown',
                'channels'  => $c['channels'] ?? 0,
                'protocol'  => $c['protocol'] ?? 'AMQP 0-9-1',
                'peer_host' => $c['peer_host'] ?? '',
                'peer_port' => $c['peer_port'] ?? 0,
                'client_properties' => $c['client_properties'] ?? [],
            ];
        }, $connections);

        return [
            'connections' => $summarised,
            'total'       => count($summarised),
        ];
    }
}
