<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HeyGenListTemplates implements Tool
{
    public function __construct(
        private HeyGenService $service,
    ) {}

    public function name(): string
    {
        return 'heygen_list_templates';
    }

    public function description(): string
    {
        return 'List available video templates from HeyGen. Returns template IDs, names, thumbnails, and metadata. Use limit and offset for pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of templates to return (default: 10, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of templates to skip for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('HeyGen integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listTemplates($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
