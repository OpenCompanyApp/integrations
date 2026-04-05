<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a conversation thread for the Assistants API.
 *
 * Threads hold messages and are used to manage conversation context
 * with an assistant. Optionally pre-populate with initial messages.
 */
class OpenAICreateThread implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_create_thread';
    }

    public function description(): string
    {
        return 'Create a conversation thread for the OpenAI Assistants API. Optionally include initial messages.';
    }

    public function parameters(): array
    {
        return [
            'messages' => ['type' => 'array', 'description' => 'Initial messages for the thread. Each message has "role" and "content".', 'items' => ['type' => 'object']],
        ];
    }

    /**
     * Create a new thread, optionally with initial messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments (messages)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $data = [];

            if (isset($args['messages'])) {
                $data['messages'] = $args['messages'];
            }

            $result = $this->service->createThread($data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'object' => $result['object'] ?? '',
                'created_at' => $result['created_at'] ?? 0,
                'metadata' => $result['metadata'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
