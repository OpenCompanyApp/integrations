<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\Integrations\MessageBird\MessageBirdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List MessageBird SMS messages.
 *
 * Supports official message listing filters and pagination.
 */
class MessageBirdListMessages implements Tool
{
    /**
     * @param  MessageBirdService  $service  The MessageBird REST API client
     */
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
            'originator' => ['type' => 'string', 'description' => 'Filter by originator.'],
            'recipient' => ['type' => 'string', 'description' => 'Filter by recipient.'],
            'contact_id' => ['type' => 'string', 'description' => 'Filter by contact ID.'],
        ];
    }

    /**
     * List messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            $result = $this->service->listMessages(array_filter([
                'limit' => isset($args['limit']) ? (int) $args['limit'] : null,
                'offset' => isset($args['offset']) ? (int) $args['offset'] : null,
                'status' => $args['status'] ?? null,
                'direction' => $args['direction'] ?? null,
                'originator' => $args['originator'] ?? null,
                'recipient' => $args['recipient'] ?? null,
                'contact_id' => $args['contact_id'] ?? null,
            ], static fn (mixed $value): bool => $value !== null));

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
