<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\Integrations\MessageBird\MessageBirdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MessageBirdListMessages implements Tool
{
    public function __construct(
        private MessageBirdService $service,
    ) {}

    public function name(): string
    {
        return 'messagebird_list_messages';
    }

    public function description(): string
    {
        return 'List sent and received messages from MessageBird. Supports filtering by status and direction, with pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of messages to return (default: 20, max: 1000).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'status' => ['type' => 'string', 'description' => 'Filter by message status: scheduled, sent, buffered, delivered, expired, delivery_failed.'],
            'direction' => ['type' => 'string', 'description' => 'Filter by direction: mt (outgoing / mobile terminated), mo (incoming / mobile originated).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $status = $args['status'] ?? null;
            $direction = $args['direction'] ?? null;

            $result = $this->service->listMessages($limit, $offset, $status, $direction);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
