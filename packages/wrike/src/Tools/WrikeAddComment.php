<?php

namespace OpenCompany\Integrations\Wrike\Tools;

use OpenCompany\Integrations\Wrike\WrikeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a comment to a Wrike task.
 */
class WrikeAddComment implements Tool
{
    /**
     * @param  WrikeService  $service  The Wrike API client
     */
    public function __construct(
        private WrikeService $service,
    ) {}

    public function name(): string
    {
        return 'wrike_add_comment';
    }

    public function description(): string
    {
        return 'Add a comment to a Wrike task.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the task to comment on.'],
            'text'    => ['type' => 'string', 'required' => true, 'description' => 'Comment text (supports Markdown).'],
        ];
    }

    /**
     * Add a comment to the specified task.
     *
     * @param  array<string, mixed>  $args  Tool arguments (task_id, text)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Wrike integration is not configured.');
            }

            $taskId = $args['task_id'] ?? '';
            $text = $args['text'] ?? '';

            if (empty($taskId)) {
                return ToolResult::error('task_id is required.');
            }
            if (empty($text)) {
                return ToolResult::error('text is required.');
            }

            $comment = $this->service->addComment($taskId, $text);

            return ToolResult::success($comment);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
