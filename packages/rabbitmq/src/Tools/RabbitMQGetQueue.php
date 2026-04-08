<?php

namespace OpenCompany\Integrations\RabbitMQ\Tools;

use OpenCompany\Integrations\RabbitMQ\RabbitMQService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: get detailed information about a specific RabbitMQ queue.
 *
 * Calls <code>GET /api/queues/{vhost}/{name}</code> on the RabbitMQ
 * Management API and returns the full queue details including bindings,
 * policy, arguments, and message statistics.
 */
class RabbitMQGetQueue implements Tool
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
        return 'rabbitmq_get_queue';
    }

    /**
     * Human-readable description presented to the AI agent.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific RabbitMQ queue, including message counts, consumers, bindings, policy, and arguments.';
    }

    /**
     * Input parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'vhost' => ['type' => 'string', 'required' => true, 'description' => 'The virtual host containing the queue (e.g., "/").'],
            'name'  => ['type' => 'string', 'required' => true, 'description' => 'The queue name.'],
        ];
    }

    /**
     * Execute the tool call.
     *
     * @param array<string, mixed> $args Tool arguments.
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('RabbitMQ integration is not configured.');
            }

            $vhost = $args['vhost'];
            $name  = $args['name'];

            $result = $this->service->getQueue($vhost, $name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
