<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\Integrations\Devin\DevinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a message to an existing Devin session.
 *
 * Supports the v3 session messages endpoint and legacy v1 message endpoint.
 */
class DevinSendMessage implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
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
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'The Devin session ID. Current v3 IDs are usually prefixed with devin-.'],
            'message' => ['type' => 'string', 'required' => true, 'description' => 'The message content to send to the session.'],
            'message_as_user_id' => ['type' => 'string', 'description' => 'Optional v3 user ID to attribute the message to.'],
        ];
    }

    /**
     * Send the message.
     *
     * @param  array<string, mixed>  $args  Tool arguments (session_id, message, optional message_as_user_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            $result = $this->service->sendMessage($args['session_id'], $args['message'], $args['message_as_user_id'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
