<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List file revisions in Dropbox.
 */
class DropboxListRevisions implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_list_revisions';
    }

    public function description(): string
    {
        return 'List revisions of a file in Dropbox. Returns previous versions with revision IDs that can be used with dropbox_restore to recover an earlier version.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Path to the file, e.g. "/Documents/report.txt".'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of revisions to return (1-100). Default: 10.'],
        ];
    }

    /**
     * List file revisions.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, limit)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Dropbox is not configured. Missing access token.');
        }

        $path = $args['path'] ?? '';

        if (empty($path)) {
            return ToolResult::error('A file path is required.');
        }

        try {
            $params = ['path' => $path];

            if (isset($args['limit'])) {
                $params['limit'] = $args['limit'];
            }

            $result = $this->service->listRevisions($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
