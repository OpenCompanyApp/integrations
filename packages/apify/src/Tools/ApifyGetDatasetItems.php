<?php

namespace OpenCompany\Integrations\Apify\Tools;

use OpenCompany\Integrations\Apify\ApifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve items from an Apify dataset.
 *
 * Returns the actual data items stored in a dataset. Supports format selection
 * (JSON, CSV, etc.) and pagination via limit/offset.
 */
class ApifyGetDatasetItems implements Tool
{
    public function __construct(
        private ApifyService $service,
    ) {}

    public function name(): string
    {
        return 'apify_get_dataset_items';
    }

    public function description(): string
    {
        return 'Retrieve items from an Apify dataset. Supports JSON, CSV, and other formats. Use this to get the results from completed actor runs. Datasets are referenced by ID from run results.';
    }

    public function parameters(): array
    {
        return [
            'datasetId' => ['type' => 'string', 'required' => true, 'description' => 'The dataset ID (e.g., from a run\'s defaultDatasetId).'],
            'format' => ['type' => 'string', 'description' => 'Response format: "json" (default), "csv", "xml", "html", "xlsx", "rss", or "jsonl".'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of items to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of items to skip (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apify integration is not configured.');
            }

            $datasetId = $args['datasetId'];
            $format = $args['format'] ?? 'json';
            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->getDatasetItems($datasetId, $format, $limit, $offset);

            if (is_string($result)) {
                return ToolResult::success([
                    'format' => $format,
                    'data' => $result,
                    'datasetId' => $datasetId,
                    'limit' => $limit,
                    'offset' => $offset,
                ]);
            }

            $items = $result;

            return ToolResult::success([
                'items' => $items,
                'datasetId' => $datasetId,
                'format' => $format,
                'count' => count($items),
                'limit' => $limit,
                'offset' => $offset,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
