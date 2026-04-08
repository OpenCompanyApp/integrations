<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\Integrations\OneDrive\OneDriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload a file to OneDrive.
 *
 * Uses the Microsoft Graph simple upload API to create or replace a file
 * at the specified path. Supports files up to 4 MB.
 */
class OneDriveUploadFile implements Tool
{
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_upload_file';
    }

    public function description(): string
    {
        return 'Upload a file to OneDrive. Specify the destination path and file content. Creates the file if it does not exist, or replaces it if it does. Supports files up to 4 MB via the simple upload API.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'The destination path in OneDrive, relative to the root (e.g., "Documents/report.txt" or "photos/image.png").'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The content of the file to upload.'],
            'content_type' => ['type' => 'string', 'description' => 'The MIME type of the file (e.g., "text/plain", "application/json", "image/png"). Defaults to "application/octet-stream".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneDrive integration is not configured.');
            }

            if (empty($args['path'])) {
                return ToolResult::error('The "path" parameter is required.');
            }

            if (empty($args['content'])) {
                return ToolResult::error('The "content" parameter is required.');
            }

            $contentType = $args['content_type'] ?? 'application/octet-stream';
            $result = $this->service->uploadFile($args['path'], $args['content'], $contentType);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'name' => $result['name'] ?? null,
                'size' => $result['size'] ?? 0,
                'created_at' => $result['createdDateTime'] ?? null,
                'modified_at' => $result['lastModifiedDateTime'] ?? null,
                'web_url' => $result['webUrl'] ?? null,
                'message' => "File uploaded successfully to {$args['path']}",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
