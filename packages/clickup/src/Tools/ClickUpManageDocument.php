<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpManageDocument implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_manage_document';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a ClickUp document in a space, folder, or list.
        Specify the parent container and visibility (PUBLIC or PRIVATE).
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Document name/title.'],
            'parent_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the parent container (space, folder, or list).'],
            'parent_type' => ['type' => 'string', 'required' => true, 'description' => 'Type of parent: "space", "folder", "list", "everything", or "workspace".'],
            'visibility' => ['type' => 'string', 'description' => 'Document visibility: "PUBLIC" or "PRIVATE". Default: PUBLIC.'],
            'create_page' => ['type' => 'boolean', 'description' => 'Create an initial blank page. Default: true.'],
            'workspace_id' => ['type' => 'string', 'description' => 'Workspace ID. Uses configured default if omitted.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $name = $args['name'] ?? '';
            $parentId = $args['parent_id'] ?? '';
            $parentType = $args['parent_type'] ?? '';

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }
            if (empty($parentId)) {
                return ToolResult::error('parent_id is required.');
            }
            if (empty($parentType)) {
                return ToolResult::error('parent_type is required (space, folder, list).');
            }

            $workspaceId = $args['workspace_id'] ?? $this->service->getWorkspaceId();
            if (empty($workspaceId)) {
                return ToolResult::error('Workspace ID is required for documents. Configure it in settings or pass workspace_id.');
            }

            // Map human-readable parent types to API codes
            $typeMap = [
                'space' => '4',
                'folder' => '5',
                'list' => '6',
                'everything' => '7',
                'workspace' => '12',
            ];

            $apiType = $typeMap[$parentType] ?? $parentType;

            $data = [
                'name' => $name,
                'parent' => [
                    'id' => $parentId,
                    'type' => $apiType,
                ],
                'visibility' => $args['visibility'] ?? 'PUBLIC',
                'create_page' => isset($args['create_page']) ? (bool) $args['create_page'] : true,
            ];

            $result = $this->service->createDocument($workspaceId, $data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
