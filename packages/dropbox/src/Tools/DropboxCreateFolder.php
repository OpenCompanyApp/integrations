<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new folder in Dropbox.
 */
class DropboxCreateFolder implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_create_folder';
    }

    public function description(): string
    {
        return 'Create a new folder in Dropbox at the specified path. Parent folders are created automatically. Set autorename to true to avoid conflicts with existing folders.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Path for the new folder, e.g. "/Projects/NewProject".'],
            'autorename' => ['type' => 'boolean', 'description' => 'If true and a folder with the same name exists, auto-rename. Default: false.'],
        ];
    }

    /**
     * Create a new folder in Dropbox.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, autorename)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Dropbox is not configured. Missing access token.');
        }

        $path = $args['path'] ?? '';

        if (empty($path)) {
            return ToolResult::error('A folder path is required.');
        }

        try {
            $params = ['path' => $path];

            if (isset($args['autorename'])) {
                $params['autorename'] = $args['autorename'];
            }

            $result = $this->service->createFolder($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
