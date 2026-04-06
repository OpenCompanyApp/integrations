<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\Integrations\OneDrive\OneDriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List files and folders in the root of the user's OneDrive.
 *
 * Returns a paginated list of drive items including files and folders
 * with their metadata (name, size, created/modified dates, etc.).
 */
class OneDriveListFiles implements Tool
{
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_list_files';
    }

    public function description(): string
    {
        return 'List files and folders in the root of the user\'s OneDrive. Returns item names, IDs, sizes, and metadata. Use the item ID with onedrive_get_file or onedrive_download_file for details or content.';
    }

    public function parameters(): array
    {
        return [
            'top' => ['type' => 'integer', 'description' => 'Maximum number of items to return (default: 100, max: 999).'],
            'skip_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response to fetch the next page of results.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneDrive integration is not configured.');
            }

            $top = isset($args['top']) ? (int) $args['top'] : 100;
            $skipToken = $args['skip_token'] ?? null;

            $result = $this->service->listFiles($top, $skipToken);

            $items = array_map(function (array $item): array {
                return [
                    'id' => $item['id'] ?? null,
                    'name' => $item['name'] ?? null,
                    'type' => isset($item['folder']) ? 'folder' : 'file',
                    'size' => $item['size'] ?? 0,
                    'created_at' => $item['createdDateTime'] ?? null,
                    'modified_at' => $item['lastModifiedDateTime'] ?? null,
                    'web_url' => $item['webUrl'] ?? null,
                    'mime_type' => $item['file']['mimeType'] ?? null,
                ];
            }, $result['value'] ?? []);

            $response = [
                'items' => $items,
                'count' => count($items),
            ];

            if (isset($result['@odata.nextLink'])) {
                $response['next_link'] = $result['@odata.nextLink'];
                $response['has_more'] = true;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
