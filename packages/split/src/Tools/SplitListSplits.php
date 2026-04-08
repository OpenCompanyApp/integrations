<?php

namespace OpenCompany\Integrations\Split\Tools;

use OpenCompany\Integrations\Split\SplitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SplitListSplits implements Tool
{
    public function __construct(
        private SplitService $service,
    ) {}

    public function name(): string
    {
        return 'split_list_splits';
    }

    public function description(): string
    {
        return 'List feature splits in a Split workspace. Returns split names, descriptions, traffic type, and creation date.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'description' => 'The workspace ID (defaults to the configured workspace).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of splits to return (default: 20, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Split integration is not configured.');
            }

            $workspaceId = $args['workspace_id'] ?? null;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listSplits($workspaceId, $limit, $offset);

            $splits = $result['objects'] ?? $result['data'] ?? [];

            $summary = array_map(function (array $split): array {
                return [
                    'name' => $split['name'] ?? '',
                    'description' => $split['description'] ?? '',
                    'trafficTypeName' => $split['trafficTypeName'] ?? '',
                    'createdAt' => $split['createdAt'] ?? null,
                    'rolloutStatus' => $split['rolloutStatus'] ?? null,
                ];
            }, $splits);

            $totalCount = $result['totalCount'] ?? count($summary);
            $offset = $result['offset'] ?? $offset;
            $limit = $result['limit'] ?? $limit;

            return ToolResult::success([
                'splits' => $summary,
                'count' => count($summary),
                'total_count' => $totalCount,
                'has_more' => ($offset + count($summary)) < $totalCount,
                'offset' => $offset,
                'limit' => $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
