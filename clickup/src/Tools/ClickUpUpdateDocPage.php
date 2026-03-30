<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpUpdateDocPage implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_update_doc_page';
    }

    public function description(): string
    {
        return 'Update an existing page in a ClickUp document. Supports replace, append, or prepend content.';
    }

    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'Page ID.'],
            'name' => ['type' => 'string', 'description' => 'New page name/title.'],
            'content' => ['type' => 'string', 'description' => 'New page content.'],
            'content_format' => ['type' => 'string', 'description' => 'Content format: "text/md" (default) or "text/html".'],
            'edit_mode' => ['type' => 'string', 'description' => 'Edit mode: "replace" (default), "append", or "prepend".'],
            'sub_title' => ['type' => 'string', 'description' => 'New page subtitle.'],
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

            $pageId = $args['page_id'] ?? '';
            if (empty($pageId)) {
                return ToolResult::error('page_id is required.');
            }

            $workspaceId = $args['workspace_id'] ?? $this->service->getWorkspaceId();
            if (empty($workspaceId)) {
                return ToolResult::error('Workspace ID is required. Configure it in settings or pass workspace_id.');
            }

            $data = [];

            if (isset($args['name'])) {
                $data['name'] = $args['name'];
            }
            if (isset($args['sub_title'])) {
                $data['sub_title'] = $args['sub_title'];
            }
            if (isset($args['content'])) {
                $data['content'] = $args['content'];
                $data['content_format'] = $args['content_format'] ?? 'text/md';
                $data['content_edit_mode'] = $args['edit_mode'] ?? 'replace';
            }

            if (empty($data)) {
                return ToolResult::error('At least one field to update (name, sub_title, content) is required.');
            }

            $this->service->updateDocumentPage($workspaceId, $documentId, $pageId, $data);

            return ToolResult::success("Page '{$pageId}' updated successfully.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
