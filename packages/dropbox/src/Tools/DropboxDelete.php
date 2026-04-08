<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a file or folder from Dropbox.
 */
class DropboxDelete implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_delete';
    }

    public function description(): string
    {
        return 'Delete a file or folder at the given path in Dropbox. This action can be undone within the recovery window by restoring the file from revisions.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Path to the file or folder to delete, e.g. "/Documents/old_report.txt".'],
        ];
    }

    /**
     * Delete a file or folder from Dropbox.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Dropbox is not configured. Missing access token.');
        }

        $path = $args['path'] ?? '';

        if (empty($path)) {
            return ToolResult::error('A path is required.');
        }

        try {
            $result = $this->service->delete(['path' => $path]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
