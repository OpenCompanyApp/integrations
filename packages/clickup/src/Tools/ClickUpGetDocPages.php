<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpGetDocPages implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_get_doc_pages';
    }

    public function description(): string
    {
        return 'Get the content of specific pages from a ClickUp document.';
    }

    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
            'page_ids' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated page IDs to retrieve.'],
            'content_format' => ['type' => 'string', 'description' => 'Content format: "text/md" (default) or "text/html".'],
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

            $pageIds = $args['page_ids'] ?? '';
            if (empty($pageIds)) {
                return ToolResult::error('page_ids is required (comma-separated).');
            }

            $workspaceId = $args['workspace_id'] ?? $this->service->getWorkspaceId();
            if (empty($workspaceId)) {
                return ToolResult::error('Workspace ID is required. Configure it in settings or pass workspace_id.');
            }

            $ids = is_string($pageIds) ? explode(',', $pageIds) : $pageIds;

            $params = [
                'page_ids' => array_map('trim', $ids),
            ];

            if (isset($args['content_format'])) {
                $params['content_format'] = $args['content_format'];
            }

            $result = $this->service->getDocumentPages($workspaceId, $documentId, $params);
            $pages = $result['pages'] ?? [];

            if (empty($pages)) {
                return ToolResult::success('No page content found.');
            }

            return ToolResult::success(['pages' => $pages]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
