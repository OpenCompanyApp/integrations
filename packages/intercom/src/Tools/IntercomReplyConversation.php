<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Reply to an existing Intercom conversation.
 *
 * Supports admin and user replies with a message body.
 */
class IntercomReplyConversation implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_reply_conversation';
    }

    public function description(): string
    {
        return <<<'MD'
        Reply to an existing Intercom conversation.
        Specify message_type as "admin" or "user". For admin replies, provide admin_id.
        Returns the reply confirmation.
        MD;
    }

    public function parameters(): array
    {
        return [
            'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Intercom conversation ID.'],
            'message_type' => ['type' => 'string', 'required' => true, 'description' => 'Type of reply: "admin" or "user".'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'Reply message body.'],
            'admin_id' => ['type' => 'string', 'description' => 'Intercom admin ID (required for admin replies).'],
        ];
    }

    /**
     * Reply to an Intercom conversation.
     *
     * @param  array<string, mixed>  $args  Tool arguments (conversation_id, message_type, body, admin_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $conversationId = $args['conversation_id'] ?? '';
            if (empty($conversationId)) {
                return ToolResult::error('conversation_id is required.');
            }

            $messageType = $args['message_type'] ?? '';
            if (empty($messageType)) {
                return ToolResult::error('message_type is required.');
            }

            $body = $args['body'] ?? '';
            if (empty($body)) {
                return ToolResult::error('body is required.');
            }

            $data = [
                'message_type' => $messageType,
                'body' => $body,
                'type' => $messageType,
            ];

            if ($messageType === 'admin' && ! empty($args['admin_id'])) {
                $data['admin_id'] = $args['admin_id'];
            }

            $result = $this->service->replyConversation($conversationId, $data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'conversation_id' => $conversationId,
                'message_type' => $messageType,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
