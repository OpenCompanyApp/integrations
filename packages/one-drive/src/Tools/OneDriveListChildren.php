<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OneDrive\OneDriveService;

/**
 * List children of the root folder or a specific OneDrive folder.
 *
 * Uses Microsoft Graph DriveItem children endpoints.
 */
class OneDriveListChildren implements Tool
{
    /**
     * @param  OneDriveService  $service  Microsoft Graph OneDrive API client.
     */
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_list_children';
    }

    public function description(): string
    {
        return 'List files and folders under the root folder or under a specific OneDrive parent item.';
    }

    public function parameters(): array
    {
        return [
            'parent_id' => ['type' => 'string', 'description' => 'Optional parent folder item ID. Omit to list root children.'],
            'top' => ['type' => 'integer', 'description' => 'Maximum number of items to return (default: 100, max: 999).'],
            'skip_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
        ];
    }

    /**
     * Fetch DriveItem children.
     *
     * @param  array<string, mixed>  $args  Tool arguments (parent_id, top, skip_token)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneDrive integration is not configured.');
            }

            return ToolResult::success($this->service->listChildren(
                $args['parent_id'] ?? null,
                isset($args['top']) ? (int) $args['top'] : 100,
                $args['skip_token'] ?? null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
