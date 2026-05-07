<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\Integrations\RabbitMQ\RabbitMQService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: list all RabbitMQ exchanges.
 *
 * Calls <code>GET /api/exchanges</code> on the RabbitMQ Management API and
 * returns a summarised list of every exchange across all virtual hosts.
 */
class RabbitMQListExchanges implements Tool
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
        return 'rabbitmq_list_exchanges';
    }

    /**
     * Human-readable description presented to the AI agent.
     */
    public function description(): string
    {
        return 'List all RabbitMQ exchanges across all virtual hosts. Returns exchange names, types, vhost, and durability.';
    }

    /**
     * Input parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'description' => 'Optional virtual host name.'],
            'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
        ];
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

            $exchanges = $this->service->listExchanges(isset($args['vhost']) ? (string) $args['vhost'] : null, $args['params'] ?? []);

            return ToolResult::success(array_is_list($exchanges) ? $this->formatExchanges($exchanges) : $exchanges);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Summarise raw exchange data for the agent response.
     *
     * @param array<int, array<string, mixed>> $exchanges Raw API response.
     * @return array{exchanges: array<int, array<string, mixed>>, total: int}
     */
    private function formatExchanges(array $exchanges): array
    {
        $summarised = array_map(function (array $e): array {
            return [
                'name'        => $e['name'] ?? '',
                'vhost'       => $e['vhost'] ?? '/',
                'type'        => $e['type'] ?? 'direct',
                'durable'     => $e['durable'] ?? false,
                'auto_delete' => $e['auto_delete'] ?? false,
                'internal'    => $e['internal'] ?? false,
            ];
        }, $exchanges);

        return [
            'exchanges' => $summarised,
            'total'     => count($summarised),
        ];
    }
}
