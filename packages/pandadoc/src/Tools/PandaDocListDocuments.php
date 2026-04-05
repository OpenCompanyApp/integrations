<?php

namespace OpenCompany\Integrations\PandaDoc\Tools;

use OpenCompany\Integrations\PandaDoc\PandaDocService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PandaDocListDocuments implements Tool
{
    public function __construct(
        private PandaDocService $service,
    ) {}

    public function name(): string
    {
        return 'pandadoc_list_documents';
    }

    public function description(): string
    {
        return 'List documents from PandaDoc. Returns a paginated list of documents with their IDs, names, status, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'count' => ['type' => 'integer', 'description' => 'Number of documents per page (default: 50, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PandaDoc integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $count = isset($args['count']) ? (int) $args['count'] : 50;

            $result = $this->service->listDocuments($page, $count);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
