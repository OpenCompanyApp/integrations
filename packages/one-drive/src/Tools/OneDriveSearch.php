<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OneDrive\OneDriveService;

/**
 * Search files and folders in the signed-in user's OneDrive.
 *
 * Uses the Microsoft Graph DriveItem search function.
 */
class OneDriveSearch implements Tool
{
    /**
     * @param  OneDriveService  $service  Microsoft Graph OneDrive API client.
     */
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_search';
    }

    public function description(): string
    {
        return 'Search files and folders in the signed-in user\'s OneDrive.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search text.'],
        ];
    }

    /**
     * Search the user's drive.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneDrive integration is not configured.');
            }

            if (empty($args['query'])) {
                return ToolResult::error('query is required.');
            }

            return ToolResult::success($this->service->search((string) $args['query']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
