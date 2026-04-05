<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpCreateDocPage implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_create_doc_page';
    }

    public function description(): string
    {
        return 'Create a new page in a ClickUp document.';
    }

    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Page name/title.'],
            'content' => ['type' => 'string', 'description' => 'Page content.'],
            'content_format' => ['type' => 'string', 'description' => 'Content format: "text/md" (default) or "text/html".'],
            'sub_title' => ['type' => 'string', 'description' => 'Page subtitle.'],
            'parent_page_id' => ['type' => 'string', 'description' => 'Parent page ID for creating sub-pages.'],
            'workspace_id' => ['type' => 'string', 'description' => 'Workspace ID. Uses configured default if omitted.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $documentId = $args['document_id'] ?? '';
            if (empty($documentId)) {
                return ToolResult::error('document_id is required.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $workspaceId = $args['workspace_id'] ?? $this->service->getWorkspaceId();
            if (empty($workspaceId)) {
                return ToolResult::error('Workspace ID is required. Configure it in settings or pass workspace_id.');
            }

            $content = $args['content'] ?? '';

            $data = [
                'name' => $name,
                'content' => $content,
                'content_format' => $args['content_format'] ?? 'text/md',
            ];

            if (isset($args['sub_title'])) {
                $data['sub_title'] = $args['sub_title'];
            }
            if (isset($args['parent_page_id'])) {
                $data['parent_page_id'] = $args['parent_page_id'];
            }

            $result = $this->service->createDocumentPage($workspaceId, $documentId, $data);

            return ToolResult::success(['id' => $result['id'] ?? '']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
