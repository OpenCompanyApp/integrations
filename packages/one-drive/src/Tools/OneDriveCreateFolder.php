<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OneDrive\OneDriveService;

/**
 * Create a folder in OneDrive.
 *
 * Supports root-folder creation and creation under a specific parent item.
 */
class OneDriveCreateFolder implements Tool
{
    /**
     * @param  OneDriveService  $service  Microsoft Graph OneDrive API client.
     */
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_create_folder';
    }

    public function description(): string
    {
        return 'Create a folder in OneDrive using the Microsoft Graph DriveItem children endpoint.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Folder name.'],
            'parent_id' => ['type' => 'string', 'description' => 'Optional parent folder item ID. Omit to create in root.'],
            'conflict_behavior' => ['type' => 'string', 'enum' => ['rename', 'replace', 'fail'], 'description' => 'Conflict behavior. Defaults to rename.'],
        ];
    }

    /**
     * Create a folder.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, parent_id, conflict_behavior)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneDrive integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('name is required.');
            }

            return ToolResult::success($this->service->createFolder(
                (string) $args['name'],
                $args['parent_id'] ?? null,
                (string) ($args['conflict_behavior'] ?? 'rename'),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
