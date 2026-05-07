<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OneDrive\OneDriveService;

/**
 * Delete a OneDrive file or folder.
 *
 * Calls the Microsoft Graph DriveItem delete endpoint.
 */
class OneDriveDeleteItem implements Tool
{
    /**
     * @param  OneDriveService  $service  Microsoft Graph OneDrive API client.
     */
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_delete_item';
    }

    public function description(): string
    {
        return 'Delete a OneDrive file or folder by drive item ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Drive item ID to delete.'],
        ];
    }

    /**
     * Delete a DriveItem.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneDrive integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('id is required.');
            }

            return ToolResult::success($this->service->deleteItem((string) $args['id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
