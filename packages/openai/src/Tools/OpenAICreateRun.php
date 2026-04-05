<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Start an assistant run on a thread.
 *
 * Creates a run that executes an assistant on a thread. The run is
 * started asynchronously — use openai_get_run to check its status.
 */
class OpenAICreateRun implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_create_run';
    }

    public function description(): string
    {
        return 'Start an assistant run on a thread. Returns the run with its initial status.';
    }

    public function parameters(): array
    {
        return [
            'thread_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the thread to run the assistant on.'],
            'assistant_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the assistant to use for this run.'],
            'instructions' => ['type' => 'string', 'description' => 'Override the assistant\'s default instructions for this run.'],
        ];
    }

    /**
     * Create a run on a thread.
     *
     * @param  array<string, mixed>  $args  Tool arguments (thread_id, assistant_id, instructions)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $threadId = $args['thread_id'] ?? '';
            $assistantId = $args['assistant_id'] ?? '';

            if (empty($threadId)) {
                return ToolResult::error('thread_id is required.');
            }
            if (empty($assistantId)) {
                return ToolResult::error('assistant_id is required.');
            }

            $data = ['assistant_id' => $assistantId];

            if (isset($args['instructions'])) {
                $data['instructions'] = $args['instructions'];
            }

            $result = $this->service->createRun($threadId, $data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'object' => $result['object'] ?? '',
                'thread_id' => $result['thread_id'] ?? $threadId,
                'assistant_id' => $result['assistant_id'] ?? $assistantId,
                'status' => $result['status'] ?? '',
                'model' => $result['model'] ?? '',
                'instructions' => $result['instructions'] ?? '',
                'created_at' => $result['created_at'] ?? 0,
                'started_at' => $result['started_at'] ?? null,
                'expires_at' => $result['expires_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
