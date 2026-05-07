<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\Integrations\OneDrive\OneDriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List files and folders shared with the current user.
 *
 * Returns items that have been shared with the authenticated user,
 * including files from other users' OneDrive or shared links.
 */
class OneDriveListShared implements Tool
{
    /**
     * @param  OneDriveService  $service  Microsoft Graph OneDrive API client.
     */
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_list_shared';
    }

    public function description(): string
    {
        return 'List files and folders that have been shared with the current user. Returns item names, IDs, sizes, and metadata for shared content.';
    }

    public function parameters(): array
    {
        return [
            'top' => ['type' => 'integer', 'description' => 'Maximum number of items to return (default: 100, max: 999).'],
            'skip_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response to fetch the next page of results.'],
        ];
    }

    /**
     * List items shared with the signed-in user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (top, skip_token)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneDrive integration is not configured.');
            }

            $top = isset($args['top']) ? (int) $args['top'] : 100;
            $skipToken = $args['skip_token'] ?? null;

            $result = $this->service->listShared($top, $skipToken);

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
