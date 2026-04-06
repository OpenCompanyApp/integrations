<?php

namespace OpenCompany\Integrations\Front\Tools;

use OpenCompany\Integrations\Front\FrontService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FrontSendMessage implements Tool
{
    public function __construct(
        private FrontService $service,
    ) {}

    public function name(): string
    {
        return 'front_send_message';
    }

    public function description(): string
    {
        return 'Send a reply message to an existing Front conversation. Supports HTML and plain-text bodies, and explicit TO/CC recipients.';
    }

    public function parameters(): array
    {
        return [
            'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'The conversation ID to reply to (e.g., "cnv_123abc").'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'HTML body of the message.'],
            'text' => ['type' => 'string', 'description' => 'Plain-text version of the message body.'],
            'to' => ['type' => 'array', 'description' => 'Array of recipient objects, each with a "handle" key. Example: [{"handle": "user@example.com"}].'],
            'cc' => ['type' => 'array', 'description' => 'Array of CC recipient objects, each with a "handle" key. Example: [{"handle": "manager@example.com"}].'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Front integration is not configured.');
            }

            $result = $this->service->sendMessage(
                id: $args['conversation_id'],
                body: $args['body'],
                text: $args['text'] ?? null,
                to: $args['to'] ?? null,
                cc: $args['cc'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
