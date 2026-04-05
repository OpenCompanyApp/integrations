<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a comment (story) to an Asana task.
 */
class AsanaAddComment implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_add_comment';
    }

    public function description(): string
    {
        return 'Add a comment to an Asana task.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'GID of the task to comment on.'],
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
                return ToolResult::error('Asana integration is not configured.');
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
