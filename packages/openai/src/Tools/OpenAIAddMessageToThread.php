<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a message to an existing thread.
 *
 * Appends a message with the specified role and content to a thread
 * in the Assistants API.
 */
class OpenAIAddMessageToThread implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_add_message_to_thread';
    }

    public function description(): string
    {
        return 'Add a message to an existing conversation thread.';
    }

    public function parameters(): array
    {
        return [
            'thread_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the thread to add the message to.'],
            'role' => ['type' => 'string', 'required' => true, 'description' => 'Role of the message sender: "user" or "assistant".'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'Text content of the message.'],
        ];
    }

    /**
     * Add a message to a thread.
     *
     * @param  array<string, mixed>  $args  Tool arguments (thread_id, role, content)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $threadId = $args['thread_id'] ?? '';
            $role = $args['role'] ?? '';
            $content = $args['content'] ?? '';

            if (empty($threadId)) {
                return ToolResult::error('thread_id is required.');
            }
            if (empty($role)) {
                return ToolResult::error('role is required.');
            }
            if (empty($content)) {
                return ToolResult::error('content is required.');
            }

            $result = $this->service->addMessageToThread($threadId, [
                'role' => $role,
                'content' => $content,
            ]);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'object' => $result['object'] ?? '',
                'role' => $result['role'] ?? $role,
                'content' => $result['content'] ?? [],
                'thread_id' => $result['thread_id'] ?? $threadId,
                'created_at' => $result['created_at'] ?? 0,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
