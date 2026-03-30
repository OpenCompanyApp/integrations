<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpAddComment implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_add_comment';
    }

    public function description(): string
    {
        return 'Add a new comment to a ClickUp task.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task ID. Supports custom IDs like "DEV-42".'],
            'comment_text' => ['type' => 'string', 'required' => true, 'description' => 'Comment text.'],
            'assignee' => ['type' => 'string', 'description' => 'User ID to assign the comment to.'],
            'notify_all' => ['type' => 'boolean', 'description' => 'Notify all assignees. Default: false.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $taskId = $args['task_id'] ?? '';
            if (empty($taskId)) {
                return ToolResult::error('task_id is required.');
            }

            $text = $args['comment_text'] ?? '';
            if (empty($text)) {
                return ToolResult::error('comment_text is required.');
            }

            // Handle custom task IDs
            $effectiveId = $taskId;
            $queryParams = $this->service->withCustomIdParams($taskId);
            if (! empty($queryParams)) {
                $effectiveId .= '?' . http_build_query($queryParams);
            }

            $data = [
                'comment_text' => $text,
            ];

            if (isset($args['assignee'])) {
                $data['assignee'] = (int) $args['assignee'];
            }

            if (isset($args['notify_all']) && $args['notify_all']) {
                $data['notify_all'] = true;
            }

            $result = $this->service->createTaskComment($effectiveId, $data);

            return ToolResult::success(['id' => $result['id'] ?? '']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
