<?php

namespace OpenCompany\Integrations\Groq\Tools;

use OpenCompany\Integrations\Groq\GroqService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Deprecated unsupported conversation message listing tool.
 */
class GroqListMessages implements Tool
{
    /**
     * @param  GroqService  $service  Groq API client.
     */
    public function __construct(
        private GroqService $service,
    ) {}

    public function name(): string
    {
        return 'groq_list_messages';
    }

    public function description(): string
    {
        return 'List messages in a Groq Cloud conversation. Returns message content, role, and metadata for each message in the conversation.';
    }

    public function parameters(): array
    {
        return [
            'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'The conversation ID to list messages for.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of messages to return per page (default: 20).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination: message ID to start after.'],
        ];
    }

    /**
     * Execute the deprecated conversation message listing request.
     *
     * @param  array<string, mixed>  $args  Legacy conversation arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Groq integration is not configured.');
            }

            if (empty($args['conversation_id'])) {
                return ToolResult::error('Conversation ID is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $after = $args['after'] ?? null;

            $result = $this->service->listMessages($args['conversation_id'], $limit, $after);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
