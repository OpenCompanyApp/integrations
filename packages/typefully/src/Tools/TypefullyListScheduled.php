<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\Integrations\Typefully\TypefullyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TypefullyListScheduled implements Tool
{
    public function __construct(
        private TypefullyService $service,
    ) {}

    public function name(): string
    {
        return 'typefully_list_scheduled';
    }

    public function description(): string
    {
        return 'List scheduled drafts in Typefully that are queued for publication. Returns draft content, scheduled dates, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of drafts to return (default: 20, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of drafts to skip for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listScheduled($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
