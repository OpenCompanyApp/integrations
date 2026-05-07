<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OneDrive\OneDriveService;

/**
 * Copy a OneDrive DriveItem asynchronously.
 *
 * Returns the monitor URL from Microsoft Graph when the copy is accepted.
 */
class OneDriveCopyItem implements Tool
{
    /**
     * @param  OneDriveService  $service  Microsoft Graph OneDrive API client.
     */
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_copy_item';
    }

    public function description(): string
    {
        return 'Copy a OneDrive file or folder asynchronously. Optionally provide a new name and parentReference.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Drive item ID to copy.'],
            'name' => ['type' => 'string', 'description' => 'Optional new name for the copy.'],
            'parent_reference' => ['type' => 'object', 'description' => 'Optional Graph parentReference object for the destination folder.'],
            'include_all_version_history' => ['type' => 'boolean', 'description' => 'Whether to include full version history when supported.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official Graph copy request fields.'],
        ];
    }

    /**
     * Start an asynchronous DriveItem copy.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, name, parent_reference, include_all_version_history, payload)
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
            if (isset($args['include_all_version_history'])) {
                $payload['includeAllVersionHistory'] = (bool) $args['include_all_version_history'];
            }

            return ToolResult::success($this->service->copyItem((string) $args['id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
