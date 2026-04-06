<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\Integrations\OneDrive\OneDriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get metadata for a specific drive item by its ID.
 *
 * Returns detailed metadata for a file or folder including name, size,
 * created/modified dates, web URL, MIME type, and thumbnails.
 */
class OneDriveGetFile implements Tool
{
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_get_file';
    }

    public function description(): string
    {
        return 'Get detailed metadata for a specific file or folder in OneDrive by its item ID. Returns name, size, dates, MIME type, and download URL.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the drive item (obtained from onedrive_list_files or onedrive_list_shared).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneDrive integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $item = $this->service->getFile($args['id']);

            $result = [
                'id' => $item['id'] ?? null,
                'name' => $item['name'] ?? null,
                'type' => isset($item['folder']) ? 'folder' : 'file',
                'size' => $item['size'] ?? 0,
                'created_at' => $item['createdDateTime'] ?? null,
                'modified_at' => $item['lastModifiedDateTime'] ?? null,
                'web_url' => $item['webUrl'] ?? null,
                'mime_type' => $item['file']['mimeType'] ?? null,
                'download_url' => $item['@content.downloadUrl'] ?? null,
                'parent_reference' => $item['parentReference'] ?? null,
            ];

            if (isset($item['folder'])) {
                $result['child_count'] = $item['folder']['childCount'] ?? 0;
            }

            if (isset($item['file'])) {
                $result['file_hash'] = $item['file']['hashes'] ?? null;
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
