<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\BlandAI\BlandAIService;

/**
 * Chat with a Bland AI knowledge base.
 *
 * Performs conversational retrieval against a knowledge base.
 */
class BlandAIChatKnowledgeBase implements Tool
{
    /**
     * @param  BlandAIService  $service  The Bland AI API client
     */
    public function __construct(private BlandAIService $service) {}

    public function name(): string
    {
        return 'blandai_chat_knowledge_base';
    }

    public function description(): string
    {
        return 'Ask a question or continue a chat against a Bland AI knowledge base.';
    }

    public function parameters(): array
    {
        return [
            'knowledge_base_id' => ['type' => 'string', 'required' => true, 'description' => 'Knowledge base ID.'],
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Chat messages with role and content.'],
        ];
    }

    /**
     * Chat with a knowledge base.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }
            if (! is_array($args['messages'] ?? null)) {
                return ToolResult::error('messages must be an array.');
            }

            return ToolResult::success($this->service->chatKnowledgeBase((string) ($args['knowledge_base_id'] ?? ''), $args['messages']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
