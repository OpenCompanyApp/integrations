<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Send a LINE reply message.
 *
 * Uses a reply token from a webhook event to respond in-context.
 */
class LineReplyMessage implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_reply_message';
    }

    public function description(): string
    {
        return 'Send a reply message using a webhook reply token.';
    }

    public function parameters(): array
    {
        return [
            'reply_token' => ['type' => 'string', 'required' => true, 'description' => 'Reply token from a webhook event.'],
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of LINE message objects.'],
            'notification_disabled' => ['type' => 'boolean', 'description' => 'Disable push notification when true.'],
        ];
    }

    /**
     * Send a reply message.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->replyMessage((string) ($args['reply_token'] ?? ''), $args['messages'] ?? [], (bool) ($args['notification_disabled'] ?? false)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
