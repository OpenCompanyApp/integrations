<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * Delete a scheduled SMS message.
 *
 * Uses the MessageBird SMS API delete endpoint for messages that can still be cancelled.
 */
class MessageBirdDeleteMessage implements Tool
{
    /**
     * @param  MessageBirdService  $service  The MessageBird REST API client
     */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string
    {
        return 'messagebird_delete_message';
    }

    public function description(): string
    {
        return 'Delete a scheduled MessageBird SMS message.';
    }

    public function parameters(): array
    {
        return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.']];
    }

    /**
     * Delete a scheduled message.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->deleteMessage((string) ($args['id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
