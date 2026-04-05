<?php

namespace OpenCompany\Integrations\PandaDoc\Tools;

use OpenCompany\Integrations\PandaDoc\PandaDocService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PandaDocListTemplates implements Tool
{
    public function __construct(
        private PandaDocService $service,
    ) {}

    public function name(): string
    {
        return 'pandadoc_list_templates';
    }

    public function description(): string
    {
        return 'List available document templates from PandaDoc. Returns template IDs, names, and metadata for creating new documents.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PandaDoc integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listTemplates($page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
