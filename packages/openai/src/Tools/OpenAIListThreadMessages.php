<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List messages in a conversation thread.
 *
 * Returns messages from the specified thread, ordered by creation time.
 */
class OpenAIListThreadMessages implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_list_thread_messages';
    }

    public function description(): string
    {
        return 'List messages in an OpenAI conversation thread.';
    }

    public function parameters(): array
    {
        return [
            'thread_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the thread to list messages from.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of messages to return (default 20, max 100).'],
        ];
    }

    /**
     * List messages in a thread.
     *
     * @param  array<string, mixed>  $args  Tool arguments (thread_id, limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $threadId = $args['thread_id'] ?? '';

            if (empty($threadId)) {
                return ToolResult::error('thread_id is required.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listThreadMessages($threadId, $params);

            return ToolResult::success([
                'object' => $result['object'] ?? '',
                'data' => $result['data'] ?? [],
                'first_id' => $result['first_id'] ?? null,
                'last_id' => $result['last_id'] ?? null,
                'has_more' => $result['has_more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
