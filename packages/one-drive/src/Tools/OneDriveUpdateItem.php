<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OneDrive\OneDriveService;

/**
 * Update OneDrive DriveItem metadata.
 *
 * Supports rename, move via parentReference, and other Graph DriveItem update fields.
 */
class OneDriveUpdateItem implements Tool
{
    /**
     * @param  OneDriveService  $service  Microsoft Graph OneDrive API client.
     */
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_update_item';
    }

    public function description(): string
    {
        return 'Update OneDrive file or folder metadata. Use name to rename, parent_reference to move, or payload for official Graph fields.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Drive item ID.'],
            'name' => ['type' => 'string', 'description' => 'New item name.'],
            'parent_reference' => ['type' => 'object', 'description' => 'Graph parentReference object for moving an item.'],
            'payload' => ['type' => 'object', 'description' => 'Additional Graph DriveItem update fields.'],
        ];
    }

    /**
     * Update DriveItem metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, name, parent_reference, payload)
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

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            if (isset($args['name'])) {
                $payload['name'] = $args['name'];
            }
            if (isset($args['parent_reference']) && is_array($args['parent_reference'])) {
                $payload['parentReference'] = $args['parent_reference'];
            }

            if ($payload === []) {
                return ToolResult::error('At least one update field is required.');
            }

            return ToolResult::success($this->service->updateItem((string) $args['id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
