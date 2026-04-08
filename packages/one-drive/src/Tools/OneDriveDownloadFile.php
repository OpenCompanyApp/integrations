<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\Integrations\OneDrive\OneDriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Download a file's content from OneDrive by its drive item ID.
 *
 * Returns the raw file content. For large files, the content is returned
 * as a string which may consume significant memory.
 */
class OneDriveDownloadFile implements Tool
{
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_download_file';
    }

    public function description(): string
    {
        return 'Download a file\'s content from OneDrive by its drive item ID. Returns the raw file content. Use onedrive_list_files or onedrive_get_file to find the item ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the drive item to download.'],
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

            $content = $this->service->downloadFile($args['id']);

            return ToolResult::success([
                'content' => $content,
                'size' => strlen($content),
                'item_id' => $args['id'],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
