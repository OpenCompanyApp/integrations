<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

use OpenCompany\Integrations\GoogleDrive\GoogleDriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: gdrive_list_changes
 *
 * Lists changes to files in the user's Google Drive. Useful for
 * detecting modifications, additions, and deletions since the
 * last checked page token.
 */
class GoogleDriveListChanges implements Tool
{
    public function __construct(
        private GoogleDriveService $service,
    ) {}

    public function name(): string
    {
        return 'gdrive_list_changes';
    }

    public function description(): string
    {
        return 'List changes to files and folders in Google Drive. Use pageToken from the initial startPageToken to begin tracking, then pass the returned next page token for subsequent requests.';
    }

    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of changes to return per page (default: 100, max: 1000).'],
            'pageToken' => ['type' => 'string', 'description' => 'The token for continuing a previous list request. Use the startPageToken for the initial request.'],
            'fields' => ['type' => 'string', 'description' => 'Fields to include in the response. E.g., "changes(fileId,file(name,mimeType)),nextPageToken,newStartPageToken".'],
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
            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->listChanges($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
