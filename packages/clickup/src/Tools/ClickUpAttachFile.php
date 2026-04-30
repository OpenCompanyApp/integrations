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
        Upload a local file attachment to a ClickUp task.
        ClickUp's official task attachment endpoint requires multipart file upload;
        cloud URL passthrough is not supported by this v2 endpoint.
        MD;
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task ID to attach the file to. Supports custom IDs like "DEV-42".'],
            'file_path' => ['type' => 'string', 'required' => true, 'description' => 'Readable local file path to upload.'],
            'filename' => ['type' => 'string', 'description' => 'Optional filename override for the uploaded attachment.'],
            'file_url' => ['type' => 'string', 'description' => 'Deprecated. Public URL uploads are not supported by ClickUp v2 task attachments.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $taskId = $args['task_id'] ?? '';
            $filePath = $args['file_path'] ?? '';

            if (empty($taskId)) {
                return ToolResult::error('task_id is required.');
            }
            if (! empty($args['file_url']) && empty($args['file_path'])) {
                return ToolResult::error('file_url is not supported by ClickUp task attachments. Provide file_path for multipart upload.');
            }
            if (empty($filePath)) {
                return ToolResult::error('file_path is required.');
            }

            $result = $this->service->attachFileToTask(
                $taskId,
                $filePath,
                $args['filename'] ?? null,
                $this->service->withCustomIdParams($taskId),
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
