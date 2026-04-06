<?php

namespace OpenCompany\Integrations\GoogleDocs\Tools;

use OpenCompany\Integrations\GoogleDocs\GoogleDocsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing Google Docs documents visible to the authenticated user.
 *
 * Uses the Google Drive API to search for Google Docs files. Supports
 * pagination and custom query filtering via the Drive API query syntax.
 */
class GdocsListDocuments implements Tool
{
    /**
     * Create a new GdocsListDocuments tool instance.
     */
    public function __construct(
        private GoogleDocsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gdocs_list_documents';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List Google Docs documents visible to the authenticated user. Returns document IDs, names, owners, and modification times. Supports pagination and custom Drive API query filters.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of documents to return per page (default: 100, max: 1000).'],
            'pageToken' => ['type' => 'string', 'description' => 'Token for the next page of results, from a previous response.'],
            'q' => ['type' => 'string', 'description' => 'Drive API query string for filtering. Defaults to mimeType="application/vnd.google-apps.document". Example: "name contains \'report\' and modifiedTime > \'2025-01-01\'".'],
        ];
    }

    /**
     * Execute the list documents request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Docs integration is not configured.');
            }

            $pageSize = isset($args['pageSize']) ? (int) $args['pageSize'] : 100;
            $pageToken = $args['pageToken'] ?? null;
            $q = $args['q'] ?? null;

            $result = $this->service->listDocuments($pageSize, $pageToken, $q);

            $files = $result['files'] ?? [];
            $nextPageToken = $result['nextPageToken'] ?? null;

            $response = [
                'documents' => array_map(function (array $file): array {
                    return [
                        'id' => $file['id'] ?? null,
                        'name' => $file['name'] ?? null,
                        'mimeType' => $file['mimeType'] ?? null,
                        'createdTime' => $file['createdTime'] ?? null,
                        'modifiedTime' => $file['modifiedTime'] ?? null,
                        'owners' => array_map(fn (array $owner) => $owner['displayName'] ?? $owner['emailAddress'] ?? '', $file['owners'] ?? []),
                        'webViewLink' => $file['webViewLink'] ?? null,
                    ];
                }, $files),
                'totalCount' => count($files),
            ];

            if ($nextPageToken) {
                $response['nextPageToken'] = $nextPageToken;
                $response['hasMore'] = true;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
