<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpAddTag implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_add_tag';
    }

    public function description(): string
    {
        return 'Add an existing tag to a ClickUp task. The tag must already exist in the space.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task ID. Supports custom IDs like "DEV-42".'],
            'tag_name' => ['type' => 'string', 'required' => true, 'description' => 'Tag name to add.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $taskId = $args['task_id'] ?? '';
            $tagName = $args['tag_name'] ?? '';

            if (empty($taskId)) {
                return ToolResult::error('task_id is required.');
            }
            if (empty($tagName)) {
                return ToolResult::error('tag_name is required.');
            }

            $queryParams = $this->service->withCustomIdParams($taskId);

            $this->service->addTagToTask($taskId, $tagName, $queryParams);

            return ToolResult::success("Tag '{$tagName}' added to task successfully.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
