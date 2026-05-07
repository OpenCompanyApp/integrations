<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OneDrive\OneDriveService;

/**
 * Create or return a sharing link for a OneDrive DriveItem.
 *
 * Supports Graph createLink type, scope, expiration, and inherited-permission options.
 */
class OneDriveCreateSharingLink implements Tool
{
    /**
     * @param  OneDriveService  $service  Microsoft Graph OneDrive API client.
     */
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_create_sharing_link';
    }

    public function description(): string
    {
        return 'Create or return a sharing link for a OneDrive file or folder.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Drive item ID.'],
            'type' => ['type' => 'string', 'enum' => ['view', 'edit', 'embed'], 'description' => 'Link type. Defaults to view.'],
            'scope' => ['type' => 'string', 'enum' => ['anonymous', 'organization', 'users'], 'description' => 'Link scope. Defaults to organization.'],
            'expiration_date_time' => ['type' => 'string', 'description' => 'Optional ISO 8601 expiration date-time.'],
            'retain_inherited_permissions' => ['type' => 'boolean', 'description' => 'Whether inherited permissions are retained when first sharing.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official Graph createLink fields.'],
        ];
    }

    /**
     * Create a sharing link.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, type, scope, expiration_date_time, retain_inherited_permissions, payload)
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
            $payload['type'] = $args['type'] ?? ($payload['type'] ?? 'view');
            $payload['scope'] = $args['scope'] ?? ($payload['scope'] ?? 'organization');
            if (isset($args['expiration_date_time'])) {
                $payload['expirationDateTime'] = $args['expiration_date_time'];
            }
            if (isset($args['retain_inherited_permissions'])) {
                $payload['retainInheritedPermissions'] = (bool) $args['retain_inherited_permissions'];
            }

            return ToolResult::success($this->service->createSharingLink((string) $args['id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
