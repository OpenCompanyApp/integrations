<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Restore a file to a specific revision in Dropbox.
 */
class DropboxRestore implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_restore';
    }

    public function description(): string
    {
        return 'Restore a file to a specific revision in Dropbox. Use dropbox_list_revisions to find the revision ID, then restore the file to that version.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Path to the file to restore, e.g. "/Documents/report.txt".'],
            'rev' => ['type' => 'string', 'required' => true, 'description' => 'The revision ID to restore to, obtained from dropbox_list_revisions.'],
        ];
    }

    /**
     * Restore a file to a specific revision.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, rev)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Dropbox is not configured. Missing access token.');
        }

        $path = $args['path'] ?? '';
        $rev = $args['rev'] ?? '';

        if (empty($path)) {
            return ToolResult::error('A file path is required.');
        }

        if (empty($rev)) {
            return ToolResult::error('A revision ID (rev) is required. Use dropbox_list_revisions to find it.');
        }

        try {
            $result = $this->service->restore([
                'path' => $path,
                'rev' => $rev,
            ]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
