<?php

namespace OpenCompany\Integrations\Groq\Tools;

use OpenCompany\Integrations\Groq\GroqService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GroqCreateMessage implements Tool
{
    public function __construct(
        private GroqService $service,
    ) {}

    public function name(): string
    {
        return 'groq_create_message';
    }

    public function description(): string
    {
        return 'Create a message in a Groq Cloud conversation. Send a message with a specified role and content to a conversation.';
    }

    public function parameters(): array
    {
        return [
            'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'The conversation ID to add the message to.'],
            'role' => ['type' => 'string', 'required' => true, 'description' => 'The role of the message author (e.g., "user", "assistant").'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The text content of the message.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Groq integration is not configured.');
            }

            if (empty($args['conversation_id'])) {
                return ToolResult::error('Conversation ID is required.');
            }

            if (empty($args['role'])) {
                return ToolResult::error('Role is required.');
            }

            if (empty($args['content'])) {
                return ToolResult::error('Content is required.');
            }

            $result = $this->service->createMessage(
                $args['conversation_id'],
                $args['role'],
                $args['content'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
