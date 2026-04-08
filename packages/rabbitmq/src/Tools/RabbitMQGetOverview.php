<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\Integrations\RabbitMQ\RabbitMQService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: get RabbitMQ cluster overview.
 *
 * Calls <code>GET /api/overview</code> on the RabbitMQ Management API and
 * returns cluster-wide information including node name, RabbitMQ/Erlang
 * versions, message rates, queue totals, and listeners.
 */
class RabbitMQGetOverview implements Tool
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
        return 'rabbitmq_get_overview';
    }

    /**
     * Human-readable description presented to the AI agent.
     */
    public function description(): string
    {
        return 'Get RabbitMQ cluster overview — node info, RabbitMQ version, message rates, queue totals, and listener ports.';
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

            $result = $this->service->getOverview();

            return ToolResult::success($this->formatOverview($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Summarise the overview response for the agent.
     *
     * @param array<string, mixed> $data Raw API response.
     * @return array<string, mixed>
     */
    private function formatOverview(array $data): array
    {
        $result = [
            'node'             => $data['node'] ?? null,
            'cluster_name'     => $data['cluster_name'] ?? null,
            'rabbitmq_version' => $data['rabbitmq_version'] ?? null,
            'erlang_version'   => $data['erlang_version'] ?? null,
        ];

        if (isset($data['queue_totals'])) {
            $result['queue_totals'] = [
                'messages'               => $data['queue_totals']['messages'] ?? 0,
                'messages_ready'         => $data['queue_totals']['messages_ready'] ?? 0,
                'messages_unacknowledged' => $data['queue_totals']['messages_unacknowledged'] ?? 0,
            ];
        }

        if (isset($data['message_stats'])) {
            $result['message_stats'] = [
                'publish'        => $data['message_stats']['publish'] ?? 0,
                'deliver'        => $data['message_stats']['deliver'] ?? 0,
                'deliver_no_ack' => $data['message_stats']['deliver_no_ack'] ?? 0,
                'ack'            => $data['message_stats']['ack'] ?? 0,
                'redeliver'      => $data['message_stats']['redeliver'] ?? 0,
            ];
        }

        if (isset($data['listeners']) && is_array($data['listeners'])) {
            $result['listeners'] = array_map(function (array $l): array {
                return [
                    'protocol' => $l['protocol'] ?? '',
                    'ip_address' => $l['ip_address'] ?? '',
                    'port'     => $l['port'] ?? 0,
                ];
            }, $data['listeners']);
        }

        return $result;
    }
}
