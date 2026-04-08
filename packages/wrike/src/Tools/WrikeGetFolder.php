<?php

namespace OpenCompany\Integrations\Wrike\Tools;

use OpenCompany\Integrations\Wrike\WrikeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a Wrike folder.
 */
class WrikeGetFolder implements Tool
{
    /**
     * @param  WrikeService  $service  The Wrike API client
     */
    public function __construct(
        private WrikeService $service,
    ) {}

    public function name(): string
    {
        return 'wrike_get_folder';
    }

    public function description(): string
    {
        return 'Get detailed information about a Wrike folder.';
    }

    public function parameters(): array
    {
        return [
            'folder_id' => ['type' => 'string', 'required' => true, 'description' => 'The folder ID.'],
        ];
    }

    /**
     * Retrieve a folder by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (folder_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Wrike integration is not configured.');
            }

            $folderId = $args['folder_id'] ?? '';

            if (empty($folderId)) {
                return ToolResult::error('folder_id is required.');
            }

            $folder = $this->service->getFolder($folderId);

            return ToolResult::success($folder);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
