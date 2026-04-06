<?php

namespace OpenCompany\Integrations\GoogleDocs\Tools;

use OpenCompany\Integrations\GoogleDocs\GoogleDocsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving a specific permission for a Google Docs document.
 *
 * Uses the Google Drive API to get details of an individual permission
 * entry (user, group, or domain access).
 */
class GdocsGetPermission implements Tool
{
    /**
     * Create a new GdocsGetPermission tool instance.
     */
    public function __construct(
        private GoogleDocsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gdocs_get_permission';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Get details of a specific permission for a Google Docs document. Returns the permission type, role, and email address for a single permission entry.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'fileId' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Google Docs document.'],
            'permissionId' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the permission to retrieve. Obtain this from gdocs_list_permissions.'],
        ];
    }

    /**
     * Execute the get permission request.
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
            $permissionId = $args['permissionId'];

            $result = $this->service->getPermission($fileId, $permissionId);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'type' => $result['type'] ?? null,
                'emailAddress' => $result['emailAddress'] ?? null,
                'role' => $result['role'] ?? null,
                'displayName' => $result['displayName'] ?? null,
                'photoLink' => $result['photoLink'] ?? null,
                'expirationTime' => $result['expirationTime'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
