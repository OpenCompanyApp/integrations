<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\Integrations\Devin\DevinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DevinSendMessage implements Tool
{
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_send_message';
    }

    public function description(): string
    {
        return 'Send a message to an existing Devin session. Use this to provide additional instructions, ask questions, or guide the AI during an active session.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Devin session to send the message to.'],
            'message' => ['type' => 'string', 'required' => true, 'description' => 'The message content to send to the session.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            $result = $this->service->sendMessage($args['session_id'], $args['message']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
