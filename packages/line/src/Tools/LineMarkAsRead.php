<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Mark a LINE chat as read.
 *
 * Uses the Messaging API chat read endpoint for user, group, or room chats.
 */
class LineMarkAsRead implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_mark_as_read';
    }

    public function description(): string
    {
        return 'Mark messages in a LINE chat as read.';
    }

    public function parameters(): array
    {
        return ['chat_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE user ID, group ID, or room ID.']];
    }

    /**
     * Mark a chat as read.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->markAsRead((string) ($args['chat_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
