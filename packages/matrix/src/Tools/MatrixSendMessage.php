<?php

namespace OpenCompany\Integrations\Matrix\Tools;

use OpenCompany\Integrations\Matrix\MatrixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MatrixSendMessage implements Tool
{
    public function __construct(
        private MatrixService $service,
    ) {}

    public function name(): string
    {
        return 'matrix_send_message';
    }

    public function description(): string
    {
        return 'Send a text message to a Matrix room. Uses a unique transaction ID to prevent duplicate messages.';
    }

    public function parameters(): array
    {
        return [
            'room_id' => ['type' => 'string', 'required' => true, 'description' => 'The room ID to send the message to (e.g., "!abc123:matrix.org").'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The message body text.'],
            'msgtype' => ['type' => 'string', 'description' => 'Message type: "m.text" (default), "m.notice", "m.emote", or "m.html".'],
            'txn_id' => ['type' => 'string', 'description' => 'Unique transaction ID. If omitted, a random ID is generated.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Matrix integration is not configured.');
            }

            $roomId = $args['room_id'];
            $body = $args['body'];
            $msgtype = $args['msgtype'] ?? 'm.text';
            $txnId = $args['txn_id'] ?? uniqid('txn_', true);

            $result = $this->service->sendMessage($roomId, $txnId, $msgtype, $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
