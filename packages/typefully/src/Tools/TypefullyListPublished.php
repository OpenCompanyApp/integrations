<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\Integrations\Typefully\TypefullyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TypefullyListPublished implements Tool
{
    public function __construct(
        private TypefullyService $service,
    ) {}

    public function name(): string
    {
        return 'typefully_list_published';
    }

    public function description(): string
    {
        return 'List published drafts in Typefully. Returns content, publication dates, engagement metrics, and metadata.';
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

            $result = $this->service->listPublished($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
