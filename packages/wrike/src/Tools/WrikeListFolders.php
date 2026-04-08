<?php

namespace OpenCompany\Integrations\Wrike\Tools;

use OpenCompany\Integrations\Wrike\WrikeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List folders in Wrike with optional filters.
 */
class WrikeListFolders implements Tool
{
    /**
     * @param  WrikeService  $service  The Wrike API client
     */
    public function __construct(
        private WrikeService $service,
    ) {}

    public function name(): string
    {
        return 'wrike_list_folders';
    }

    public function description(): string
    {
        return 'List folders in Wrike with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'limit'         => ['type' => 'integer', 'description' => 'Max number of folders to return.'],
            'nextPageToken' => ['type' => 'string',  'description' => 'Cursor for pagination from a previous response.'],
        ];
    }

    /**
     * Retrieve a list of folders with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, nextPageToken)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Wrike integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['nextPageToken'])) {
                $params['nextPageToken'] = $args['nextPageToken'];
            }

            $folders = $this->service->listFolders($params);

            return ToolResult::success($folders);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
