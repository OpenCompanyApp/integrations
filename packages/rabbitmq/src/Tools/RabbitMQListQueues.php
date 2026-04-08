<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\Integrations\RabbitMQ\RabbitMQService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: list all RabbitMQ queues.
 *
 * Calls <code>GET /api/queues</code> on the RabbitMQ Management API and
 * returns a summarised list of every queue across all virtual hosts.
 */
class RabbitMQListQueues implements Tool
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
        return 'rabbitmq_list_queues';
    }

    /**
     * Human-readable description presented to the AI agent.
     */
    public function description(): string
    {
        return 'List all RabbitMQ queues across all virtual hosts. Returns queue names, vhost, message counts, consumer counts, and state.';
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

            $queues = $this->service->listQueues();

            return ToolResult::success($this->formatQueues($queues));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Summarise raw queue data for the agent response.
     *
     * @param array<int, array<string, mixed>> $queues Raw API response.
     * @return array{queues: array<int, array<string, mixed>>, total: int}
     */
    private function formatQueues(array $queues): array
    {
        $summarised = array_map(function (array $q): array {
            return [
                'name'          => $q['name'] ?? '',
                'vhost'         => $q['vhost'] ?? '/',
                'type'          => $q['type'] ?? 'classic',
                'state'         => $q['state'] ?? 'unknown',
                'messages'      => $q['messages'] ?? 0,
                'messages_ready'     => $q['messages_ready'] ?? 0,
                'messages_unacknowledged' => $q['messages_unacknowledged'] ?? 0,
                'consumers'     => $q['consumers'] ?? 0,
                'durable'       => $q['durable'] ?? false,
                'auto_delete'   => $q['auto_delete'] ?? false,
            ];
        }, $queues);

        return [
            'queues' => $summarised,
            'total'  => count($summarised),
        ];
    }
}
