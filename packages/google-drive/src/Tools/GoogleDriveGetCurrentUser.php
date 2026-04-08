<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

use OpenCompany\Integrations\GoogleDrive\GoogleDriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: gdrive_get_current_user
 *
 * Retrieves information about the authenticated user and
 * their Google Drive storage quota.
 */
class GoogleDriveGetCurrentUser implements Tool
{
    public function __construct(
        private GoogleDriveService $service,
    ) {}

    public function name(): string
    {
        return 'gdrive_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the authenticated Google Drive user, including display name, email address, and storage quota (usage, limit).';
    }

    public function parameters(): array
    {
        return [
            'fields' => ['type' => 'string', 'description' => 'Fields to include in the response. Defaults to "user,storageQuota".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Drive integration is not configured.');
            }

            $params = [];
            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
