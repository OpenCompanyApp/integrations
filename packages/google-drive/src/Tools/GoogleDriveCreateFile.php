<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

use OpenCompany\Integrations\GoogleDrive\GoogleDriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: gdrive_create_file
 *
 * Creates a new file metadata entry in Google Drive.
 * For uploading file content, use the Google Drive upload endpoints
 * directly — this tool creates the file resource (metadata-only).
 */
class GoogleDriveCreateFile implements Tool
{
    public function __construct(
        private GoogleDriveService $service,
    ) {}

    public function name(): string
    {
        return 'gdrive_create_file';
    }

    public function description(): string
    {
        return 'Create a new file in Google Drive. Creates the file metadata (name, mimeType, parent folder). For simple file creation without content upload, use uploadType "resumable" or "multipart" via the Google Drive API directly.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the file (e.g., "Report.pdf").'],
            'mimeType' => ['type' => 'string', 'description' => 'The MIME type of the file (e.g., "text/plain", "application/pdf"). If not set, Google Drive will try to auto-detect.'],
            'parents' => ['type' => 'array', 'description' => 'List of parent folder IDs to add the file to. If not specified, the file is placed in the root folder.'],
            'description' => ['type' => 'string', 'description' => 'A short description of the file.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Drive integration is not configured.');
            }

            $body = [
                'name' => $args['name'],
            ];

            if (isset($args['mimeType'])) {
                $body['mimeType'] = $args['mimeType'];
            }
            if (isset($args['parents'])) {
                $body['parents'] = $args['parents'];
            }
            if (isset($args['description'])) {
                $body['description'] = $args['description'];
            }

            $result = $this->service->createFile($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
