<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get metadata for a file or folder in Dropbox.
 */
class DropboxGetMetadata implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_get_metadata';
    }

    public function description(): string
    {
        return 'Get metadata for a file or folder in Dropbox. Returns name, path, size, modified time, and type. Optionally include media info for photos/videos or include deleted files.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Path to the file or folder, e.g. "/Documents/report.txt".'],
            'include_media_info' => ['type' => 'boolean', 'description' => 'If true, include media metadata (dimensions, GPS, etc.) for photos and videos. Default: false.'],
            'include_deleted' => ['type' => 'boolean', 'description' => 'If true, include deleted files in the response. Default: false.'],
        ];
    }

    /**
     * Get metadata for a file or folder.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, include_media_info, include_deleted)
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
            $params = ['path' => $path];

            if (isset($args['include_media_info'])) {
                $params['include_media_info'] = $args['include_media_info'];
            }
            if (isset($args['include_deleted'])) {
                $params['include_deleted'] = $args['include_deleted'];
            }

            $result = $this->service->getMetadata($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
