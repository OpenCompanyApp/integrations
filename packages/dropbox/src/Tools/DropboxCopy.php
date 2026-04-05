<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Copy a file or folder to a new location in Dropbox.
 */
class DropboxCopy implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_copy';
    }

    public function description(): string
    {
        return 'Copy a file or folder to a new location in Dropbox. Both from_path and to_path are required. Set allow_shared_folder to true to copy shared folders.';
    }

    public function parameters(): array
    {
        return [
            'from_path' => ['type' => 'string', 'required' => true, 'description' => 'Source path of the file or folder, e.g. "/Documents/report.txt".'],
            'to_path' => ['type' => 'string', 'required' => true, 'description' => 'Destination path, e.g. "/Backup/report.txt".'],
            'autorename' => ['type' => 'boolean', 'description' => 'If true and a file exists at to_path, auto-rename. Default: false.'],
            'allow_shared_folder' => ['type' => 'boolean', 'description' => 'If true, allows copying shared folders. Default: false.'],
        ];
    }

    /**
     * Copy a file or folder to a new location.
     *
     * @param  array<string, mixed>  $args  Tool arguments (from_path, to_path, autorename, allow_shared_folder)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Dropbox is not configured. Missing access token.');
        }

        $fromPath = $args['from_path'] ?? '';
        $toPath = $args['to_path'] ?? '';

        if (empty($fromPath) || empty($toPath)) {
            return ToolResult::error('Both from_path and to_path are required.');
        }

        try {
            $params = [
                'from_path' => $fromPath,
                'to_path' => $toPath,
            ];

            if (isset($args['autorename'])) {
                $params['autorename'] = $args['autorename'];
            }
            if (isset($args['allow_shared_folder'])) {
                $params['allow_shared_folder'] = $args['allow_shared_folder'];
            }

            $result = $this->service->copy($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
