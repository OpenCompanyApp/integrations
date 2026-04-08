<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a temporary link to stream a file from Dropbox.
 */
class DropboxGetTemporaryLink implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_get_temporary_link';
    }

    public function description(): string
    {
        return 'Get a temporary link to stream a file from Dropbox. The link expires after a short time. Returns both the file metadata and the temporary link URL.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Path to the file, e.g. "/Documents/report.pdf".'],
        ];
    }

    /**
     * Get a temporary streaming link for a file.
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
            $result = $this->service->getTemporaryLink(['path' => $path]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
