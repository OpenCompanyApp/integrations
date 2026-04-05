<?php

namespace OpenCompany\Integrations\Crisp\Tools;

use OpenCompany\Integrations\Crisp\CrispService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * CrispSendMessage — send a message in an existing conversation.
 *
 * Posts a message as an operator (or user) into a conversation thread.
 * Use this to reply to customers or add internal notes.
 */
class CrispSendMessage implements Tool
{
    public function __construct(
        private CrispService $service,
    ) {}

    public function name(): string
    {
        return 'crisp_send_message';
    }

    public function description(): string
    {
        return 'Send a message in a Crisp conversation. Posts as an operator by default. Use the "type" parameter to send text, notes, or file messages.';
    }

    public function parameters(): array
    {
        return [
            'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'The conversation session ID to send the message to.'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The message text to send.'],
            'type' => ['type' => 'string', 'description' => 'Message type: "text" (default), "note" (internal note), "file", etc.'],
            'from' => ['type' => 'string', 'description' => 'Message origin: "operator" (default) or "user".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Crisp integration is not configured.');
            }

            if (empty($args['conversation_id'])) {
                return ToolResult::error('conversation_id is required.');
            }

            if (empty($args['text'])) {
                return ToolResult::error('text is required.');
            }

            $type = $args['type'] ?? 'text';
            $from = $args['from'] ?? 'operator';

            $result = $this->service->sendMessage(
                $args['conversation_id'],
                $args['text'],
                $type,
                $from,
            );

            return ToolResult::success([
                'conversation_id' => $args['conversation_id'],
                'sent' => true,
                'data' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
