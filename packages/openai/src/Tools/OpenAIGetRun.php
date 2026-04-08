<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the status of a thread run.
 *
 * Retrieves the current status and details of an existing run,
 * including whether it is queued, in progress, completed, or failed.
 */
class OpenAIGetRun implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_get_run';
    }

    public function description(): string
    {
        return 'Get the status and details of an assistant run on a thread.';
    }

    public function parameters(): array
    {
        return [
            'thread_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the thread.'],
            'run_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the run to check.'],
        ];
    }

    /**
     * Get the status of a run.
     *
     * @param  array<string, mixed>  $args  Tool arguments (thread_id, run_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $threadId = $args['thread_id'] ?? '';
            $runId = $args['run_id'] ?? '';

            if (empty($threadId)) {
                return ToolResult::error('thread_id is required.');
            }
            if (empty($runId)) {
                return ToolResult::error('run_id is required.');
            }

            $result = $this->service->getRun($threadId, $runId);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'object' => $result['object'] ?? '',
                'thread_id' => $result['thread_id'] ?? $threadId,
                'assistant_id' => $result['assistant_id'] ?? '',
                'status' => $result['status'] ?? '',
                'model' => $result['model'] ?? '',
                'instructions' => $result['instructions'] ?? '',
                'created_at' => $result['created_at'] ?? 0,
                'started_at' => $result['started_at'] ?? null,
                'expires_at' => $result['expires_at'] ?? null,
                'completed_at' => $result['completed_at'] ?? null,
                'failed_at' => $result['failed_at'] ?? null,
                'last_error' => $result['last_error'] ?? null,
                'usage' => $result['usage'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
