<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List shared links for a file or folder in Dropbox.
 */
class DropboxListSharedLinks implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_list_shared_links';
    }

    public function description(): string
    {
        return 'List shared links for a specific file or folder, or list all shared links. Optionally filter by path or paginate with a cursor.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'description' => 'Path to a file or folder to filter links. Omit to list all shared links.'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor for pagination from a previous response.'],
        ];
    }

    /**
     * List shared links for a file or folder.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, cursor)
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
            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }

            $result = $this->service->listSharedLinks($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
