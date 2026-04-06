<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

use OpenCompany\Integrations\GoogleDrive\GoogleDriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: gdrive_get_file
 *
 * Retrieves metadata for a specific file or folder by its
 * Google Drive file ID.
 */
class GoogleDriveGetFile implements Tool
{
    public function __construct(
        private GoogleDriveService $service,
    ) {}

    public function name(): string
    {
        return 'gdrive_get_file';
    }

    public function description(): string
    {
        return 'Get metadata for a specific file or folder in Google Drive by its ID. Returns properties like name, mimeType, size, createdTime, modifiedTime, and parents.';
    }

    public function parameters(): array
    {
        return [
            'fileId' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the file or folder.'],
            'fields' => ['type' => 'string', 'description' => 'Fields to include in the response. E.g., "id,name,mimeType,size,modifiedTime,parents,webContentLink,webViewLink". Defaults to all fields.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Drive integration is not configured.');
            }

            $params = [];
            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->getFile($args['fileId'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
