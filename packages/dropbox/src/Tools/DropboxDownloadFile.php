<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Download a file from Dropbox.
 */
class DropboxDownloadFile implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_download_file';
    }

    public function description(): string
    {
        return 'Download a file from Dropbox. Returns the raw file content. The path must reference a file (not a folder).';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Path to the file in Dropbox, e.g. "/Documents/report.txt".'],
        ];
    }

    /**
     * Download a file from Dropbox via the content endpoint.
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
            return ToolResult::error('A file path is required.');
        }

        try {
            $result = $this->service->downloadFile(['path' => $path]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
