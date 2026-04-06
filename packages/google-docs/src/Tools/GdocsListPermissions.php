<?php

namespace OpenCompany\Integrations\GoogleDocs\Tools;

use OpenCompany\Integrations\GoogleDocs\GoogleDocsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing permissions (sharing settings) for a Google Docs document.
 *
 * Uses the Google Drive API to retrieve the list of users, groups, and
 * domains that have access to a file.
 */
class GdocsListPermissions implements Tool
{
    /**
     * Create a new GdocsListPermissions tool instance.
     */
    public function __construct(
        private GoogleDocsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gdocs_list_permissions';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List all permissions (sharing settings) for a Google Docs document. Returns who has access, their roles (owner, writer, reader), and their email addresses.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'fileId' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Google Docs document (same as the document ID).'],
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of permissions to return per page (default: 100).'],
        ];
    }

    /**
     * Execute the list permissions request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Docs integration is not configured.');
            }

            $fileId = $args['fileId'];
            $pageSize = isset($args['pageSize']) ? (int) $args['pageSize'] : 100;

            $result = $this->service->listPermissions($fileId, $pageSize);

            $permissions = $result['permissions'] ?? [];

            return ToolResult::success([
                'permissions' => array_map(function (array $perm): array {
                    return [
                        'id' => $perm['id'] ?? null,
                        'type' => $perm['type'] ?? null,
                        'emailAddress' => $perm['emailAddress'] ?? null,
                        'role' => $perm['role'] ?? null,
                        'displayName' => $perm['displayName'] ?? null,
                    ];
                }, $permissions),
                'totalCount' => count($permissions),
                'nextPageToken' => $result['nextPageToken'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
