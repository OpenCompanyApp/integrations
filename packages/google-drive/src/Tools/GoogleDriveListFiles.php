<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

use OpenCompany\Integrations\GoogleDrive\GoogleDriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: gdrive_list_files
 *
 * Lists files and folders in the user's Google Drive using the
 * Google Drive v3 API. Supports filtering, pagination, and
 * restricting results to specific spaces or corpora.
 */
class GoogleDriveListFiles implements Tool
{
    public function __construct(
        private GoogleDriveService $service,
    ) {}

    public function name(): string
    {
        return 'gdrive_list_files';
    }

    public function description(): string
    {
        return 'List files and folders in Google Drive. Supports search queries (q), pagination, spaces (drive, appDataFolder, photos), and trashed filtering.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of files to return per page (default: 100, max: 1000).'],
            'pageToken' => ['type' => 'string', 'description' => 'Token for the next page of results, from a previous list response.'],
            'q' => ['type' => 'string', 'description' => 'Query string for filtering files. E.g., "mimeType = \'application/vnd.google-apps.folder\'" to list only folders, or "name contains \'report\'" to search by name.'],
            'spaces' => ['type' => 'string', 'description' => 'Comma-separated list of spaces to query: "drive", "appDataFolder", "photos". Defaults to "drive".'],
            'trashed' => ['type' => 'boolean', 'description' => 'Whether to include trashed files. Set to true to only show trashed files, false to exclude them.'],
            'corpora' => ['type' => 'string', 'description' => 'Source of files to list: "user" (default), "domain", "allDrives", or "drive". Use "drive" with driveId parameter.'],
            'fields' => ['type' => 'string', 'description' => 'Fields to include in the response (partial response). E.g., "files(id,name,mimeType,modifiedTime)".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Drive integration is not configured.');
            }

            $params = [];

            if (isset($args['pageSize'])) {
                $params['pageSize'] = (int) $args['pageSize'];
            }
            if (isset($args['pageToken'])) {
                $params['pageToken'] = $args['pageToken'];
            }
            if (isset($args['q'])) {
                $params['q'] = $args['q'];
            }
            if (isset($args['spaces'])) {
                $params['spaces'] = $args['spaces'];
            }
            if (isset($args['trashed'])) {
                $params['trashed'] = $args['trashed'] ? 'true' : 'false';
            }
            if (isset($args['corpora'])) {
                $params['corpora'] = $args['corpora'];
            }
            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->listFiles($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
