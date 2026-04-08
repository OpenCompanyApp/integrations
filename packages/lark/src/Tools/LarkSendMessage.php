<?php

namespace OpenCompany\Integrations\Lark\Tools;

use OpenCompany\Integrations\Lark\LarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LarkSendMessage implements Tool
{
    public function __construct(
        private LarkService $service,
    ) {}

    public function name(): string
    {
        return 'lark_send_message';
    }

    public function description(): string
    {
        return 'Send a message to a specific Lark chat. Supports text and rich message types.';
    }

    public function parameters(): array
    {
        return [
            'chat_id' => ['type' => 'string', 'required' => true, 'description' => 'The chat ID to send the message to (e.g., "oc_a0553eda9014c201e6969b478895c230").'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The message content. For text messages, pass plain text or JSON like \'{"text":"Hello"}\'. For rich messages, pass the appropriate JSON structure.'],
            'msg_type' => ['type' => 'string', 'description' => 'The message type: "text", "post", "image", "file", etc. Defaults to "text".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lark integration is not configured.');
            }

            if (empty($args['chat_id'])) {
                return ToolResult::error('chat_id is required.');
            }

            if (empty($args['content'])) {
                return ToolResult::error('content is required.');
            }

            $msgType = $args['msg_type'] ?? 'text';

            $result = $this->service->sendMessage($args['chat_id'], $args['content'], $msgType);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
