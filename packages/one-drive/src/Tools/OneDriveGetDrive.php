<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OneDrive\OneDriveService;

/**
 * Get metadata for the signed-in user's default OneDrive.
 *
 * Returns drive ID, owner, quota, and drive type information.
 */
class OneDriveGetDrive implements Tool
{
    /**
     * @param  OneDriveService  $service  Microsoft Graph OneDrive API client.
     */
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_get_drive';
    }

    public function description(): string
    {
        return 'Get metadata for the signed-in user\'s default OneDrive, including drive ID, owner, quota, and drive type.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch default drive metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneDrive integration is not configured.');
            }

            return ToolResult::success($this->service->getDrive());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
