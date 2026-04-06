<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

use OpenCompany\Integrations\GoogleDrive\GoogleDriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: gdrive_create_folder
 *
 * Creates a new folder in Google Drive. A folder is a file with
 * the MIME type `application/vnd.google-apps.folder`.
 */
class GoogleDriveCreateFolder implements Tool
{
    public function __construct(
        private GoogleDriveService $service,
    ) {}

    public function name(): string
    {
        return 'gdrive_create_folder';
    }

    public function description(): string
    {
        return 'Create a new folder in Google Drive. Optionally specify a parent folder to nest it inside.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the new folder.'],
            'parentId' => ['type' => 'string', 'description' => 'ID of the parent folder. If omitted, the folder is created in the root of Google Drive.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Drive integration is not configured.');
            }

            $result = $this->service->createFolder(
                $args['name'],
                $args['parentId'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
