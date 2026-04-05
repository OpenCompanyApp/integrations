<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload a file to Dropbox.
 */
class DropboxUploadFile implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_upload_file';
    }

    public function description(): string
    {
        return 'Upload a file to Dropbox. The file content is sent as the request body. Supports add (default), overwrite, and update write modes. The path must start with a slash (e.g., "/Documents/report.txt").';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Destination path in Dropbox, e.g. "/Documents/report.txt". Must start with a slash.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The raw file content to upload.'],
            'mode' => ['type' => 'string', 'description' => 'Write mode: "add" (default, no overwrite), "overwrite", or "update" (append to existing).'],
            'autorename' => ['type' => 'boolean', 'description' => 'If true and a file already exists, Dropbox will auto-rename. Default: false.'],
            'mute' => ['type' => 'boolean', 'description' => 'If true, suppresses notifications on the file. Default: false.'],
        ];
    }

    /**
     * Upload a file to Dropbox via the content endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, content, mode, autorename, mute)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Dropbox is not configured. Missing access token.');
        }

        $path = $args['path'] ?? '';
        $content = $args['content'] ?? '';

        if (empty($path)) {
            return ToolResult::error('A destination path is required (e.g., "/Documents/file.txt").');
        }

        try {
            $params = ['path' => $path];

            if (isset($args['mode'])) {
                $params['mode'] = $args['mode'];
            }
            if (isset($args['autorename'])) {
                $params['autorename'] = $args['autorename'];
            }
            if (isset($args['mute'])) {
                $params['mute'] = $args['mute'];
            }

            $result = $this->service->uploadFile($params, $content);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
