<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpListDocPages implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_list_doc_pages';
    }

    public function description(): string
    {
        return 'List all pages in a ClickUp document.';
    }

    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
            'max_depth' => ['type' => 'integer', 'description' => 'Max page depth (-1 for unlimited).'],
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

            $workspaceId = $args['workspace_id'] ?? $this->service->getWorkspaceId();
            if (empty($workspaceId)) {
                return ToolResult::error('Workspace ID is required. Configure it in settings or pass workspace_id.');
            }

            $params = [];
            if (isset($args['max_depth'])) {
                $params['max_page_depth'] = (int) $args['max_depth'];
            }

            $result = $this->service->listDocumentPages($workspaceId, $documentId, $params);
            $pages = $result['pages'] ?? [];

            if (empty($pages)) {
                return ToolResult::success('No pages found in this document.');
            }

            $output = array_map(fn (array $p) => [
                'id' => $p['id'] ?? '',
                'name' => $p['name'] ?? '',
                'sub_title' => $p['sub_title'] ?? '',
            ], $pages);

            return ToolResult::success(['count' => count($output), 'pages' => $output]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
