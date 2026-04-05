<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpAttachFile implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_attach_file';
    }

    public function description(): string
    {
        return <<<'MD'
        Attach a file to a ClickUp task via URL.
        The file URL must be publicly accessible (http/https).
        MD;
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task ID to attach the file to. Supports custom IDs like "DEV-42".'],
            'file_url' => ['type' => 'string', 'required' => true, 'description' => 'Public URL of the file to attach (http/https).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $taskId = $args['task_id'] ?? '';
            $fileUrl = $args['file_url'] ?? '';

            if (empty($taskId)) {
                return ToolResult::error('task_id is required.');
            }
            if (empty($fileUrl)) {
                return ToolResult::error('file_url is required.');
            }

            // Handle custom task IDs
            $effectiveId = $taskId;
            $queryParams = $this->service->withCustomIdParams($taskId);
            if (! empty($queryParams)) {
                $effectiveId .= '?' . http_build_query($queryParams);
            }

            $result = $this->service->attachFileToTask($effectiveId, [
                'url' => $fileUrl,
            ]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
