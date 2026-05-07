<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * List MessageBird voice messages.
 *
 * Supports the official Voice Messaging API filters.
 */
class MessageBirdListVoiceMessages implements Tool
{
    /**
     * @param  MessageBirdService  $service  The MessageBird REST API client
     */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string
    {
        return 'messagebird_list_voice_messages';
    }

    public function description(): string
    {
        return 'List MessageBird voice messages with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum results.'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
            'originator' => ['type' => 'string', 'description' => 'Filter by originator.'],
            'recipient' => ['type' => 'string', 'description' => 'Filter by recipient.'],
            'status' => ['type' => 'string', 'description' => 'Filter by voice message status.'],
            'contact_id' => ['type' => 'string', 'description' => 'Filter by contact ID.'],
        ];
    }

    /**
     * List voice messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->listVoiceMessages(array_filter([
                'limit' => isset($args['limit']) ? (int) $args['limit'] : null,
                'offset' => isset($args['offset']) ? (int) $args['offset'] : null,
                'originator' => $args['originator'] ?? null,
                'recipient' => $args['recipient'] ?? null,
                'status' => $args['status'] ?? null,
                'contact_id' => $args['contact_id'] ?? null,
            ], static fn (mixed $value): bool => $value !== null)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
