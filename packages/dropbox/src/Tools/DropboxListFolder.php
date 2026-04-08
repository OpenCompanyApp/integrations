<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List files and folders in a Dropbox directory.
 */
class DropboxListFolder implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_list_folder';
    }

    public function description(): string
    {
        return 'List files and folders in a Dropbox directory. Use an empty string "" for the root path. Returns entries with name, path, size, and type. Use recursive=true to list all nested content. If has_more is true in the response, use dropbox_list_folder_continue with the cursor to fetch additional results.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'description' => 'Path to the folder. Use empty string "" for root, "/Photos" for the Photos folder.'],
            'recursive' => ['type' => 'boolean', 'description' => 'If true, list all nested content recursively. Default: false.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of entries to return per call (1-2000). Default: 1000.'],
        ];
    }

    /**
     * List files and folders in a Dropbox directory.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, recursive, limit)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Dropbox is not configured. Missing access token.');
        }

        try {
            $params = [];

            if (isset($args['path'])) {
                $params['path'] = $args['path'];
            }
            if (isset($args['recursive'])) {
                $params['recursive'] = $args['recursive'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = $args['limit'];
            }

            $result = $this->service->listFolder($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
