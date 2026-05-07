<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OneDrive\OneDriveService;

/**
 * Delete a sharing permission from a OneDrive DriveItem.
 *
 * Calls the Microsoft Graph permission delete endpoint.
 */
class OneDriveDeletePermission implements Tool
{
    /**
     * @param  OneDriveService  $service  Microsoft Graph OneDrive API client.
     */
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_delete_permission';
    }

    public function description(): string
    {
        return 'Delete a sharing permission from a OneDrive file or folder.';
    }

    public function parameters(): array
    {
        return [
            'item_id' => ['type' => 'string', 'required' => true, 'description' => 'Drive item ID.'],
            'permission_id' => ['type' => 'string', 'required' => true, 'description' => 'Permission ID to delete.'],
        ];
    }

    /**
     * Delete a sharing permission.
     *
     * @param  array<string, mixed>  $args  Tool arguments (item_id, permission_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneDrive integration is not configured.');
            }

            if (empty($args['item_id']) || empty($args['permission_id'])) {
                return ToolResult::error('item_id and permission_id are required.');
            }

            return ToolResult::success($this->service->deletePermission((string) $args['item_id'], (string) $args['permission_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
