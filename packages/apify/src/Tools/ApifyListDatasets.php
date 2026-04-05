<?php

namespace OpenCompany\Integrations\Apify\Tools;

use OpenCompany\Integrations\Apify\ApifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List datasets accessible to the authenticated Apify user.
 *
 * Returns a paginated list of datasets with their IDs, names, and item counts.
 */
class ApifyListDatasets implements Tool
{
    public function __construct(
        private ApifyService $service,
    ) {}

    public function name(): string
    {
        return 'apify_list_datasets';
    }

    public function description(): string
    {
        return 'List Apify datasets accessible to the authenticated user. Returns dataset IDs, names, item counts, and sizes. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'offset' => ['type' => 'integer', 'description' => 'Number of datasets to skip (default: 0).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of datasets to return (default: 20, max: 1000).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apify integration is not configured.');
            }

            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;

            $result = $this->service->listDatasets($offset, $limit);

            $data = $result['data'] ?? $result;
            $items = $data['items'] ?? $data;

            $datasets = array_map(function (array $dataset): array {
                return [
                    'id' => $dataset['id'] ?? null,
                    'name' => $dataset['name'] ?? null,
                    'itemCount' => $dataset['itemCount'] ?? 0,
                    'actId' => $dataset['actId'] ?? null,
                    'actRunId' => $dataset['actRunId'] ?? null,
                    'createdAt' => $dataset['createdAt'] ?? null,
                    'accessedAt' => $dataset['accessedAt'] ?? null,
                    'modifiedAt' => $dataset['modifiedAt'] ?? null,
                ];
            }, is_array($items) ? $items : []);

            return ToolResult::success([
                'datasets' => $datasets,
                'total' => $data['total'] ?? count($datasets),
                'offset' => $offset,
                'count' => count($datasets),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
