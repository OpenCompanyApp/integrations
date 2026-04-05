<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpReadComments implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_read_comments';
    }

    public function description(): string
    {
        return 'Get all comments on a ClickUp task. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task ID. Supports custom IDs like "DEV-42".'],
            'start' => ['type' => 'string', 'description' => 'Timestamp (ms) for pagination.'],
            'start_id' => ['type' => 'string', 'description' => 'Comment ID for pagination.'],
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

            // Handle custom task IDs
            $effectiveId = $taskId;
            $queryParams = $this->service->withCustomIdParams($taskId);
            if (! empty($queryParams)) {
                $effectiveId .= '?' . http_build_query($queryParams);
            }

            $params = [];
            if (isset($args['start'])) {
                $params['start'] = $args['start'];
            }
            if (isset($args['start_id'])) {
                $params['start_id'] = $args['start_id'];
            }

            $result = $this->service->getTaskComments($effectiveId, $params);
            $comments = $result['comments'] ?? [];

            if (empty($comments)) {
                return ToolResult::success('No comments found on this task.');
            }

            $output = array_map(function (array $c) {
                $text = '';
                foreach ($c['comment'] ?? [] as $block) {
                    $text .= $block['text'] ?? '';
                }

                return [
                    'id' => $c['id'] ?? '',
                    'text' => trim($text),
                    'user' => $c['user']['username'] ?? $c['user']['email'] ?? 'Unknown',
                    'date' => isset($c['date']) ? ClickUpService::fromMillis((int) $c['date']) : '',
                ];
            }, $comments);

            return ToolResult::success(['count' => count($output), 'comments' => $output]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
