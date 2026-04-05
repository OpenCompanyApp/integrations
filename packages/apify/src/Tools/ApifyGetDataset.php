<?php

namespace OpenCompany\Integrations\Apify\Tools;

use OpenCompany\Integrations\Apify\ApifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Apify dataset.
 *
 * Returns the dataset's metadata including item count, size, and schema.
 */
class ApifyGetDataset implements Tool
{
    public function __construct(
        private ApifyService $service,
    ) {}

    public function name(): string
    {
        return 'apify_get_dataset';
    }

    public function description(): string
    {
        return 'Get details of a specific Apify dataset, including its item count, size, name, and associated actor run. Use apify_get_dataset_items to retrieve the actual data.';
    }

    public function parameters(): array
    {
        return [
            'datasetId' => ['type' => 'string', 'required' => true, 'description' => 'The dataset ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apify integration is not configured.');
            }

            $result = $this->service->getDataset($args['datasetId']);

            $data = $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $data['id'] ?? null,
                'name' => $data['name'] ?? null,
                'itemCount' => $data['itemCount'] ?? 0,
                'actId' => $data['actId'] ?? null,
                'actRunId' => $data['actRunId'] ?? null,
                'schema' => $data['schema'] ?? null,
                'createdAt' => $data['createdAt'] ?? null,
                'accessedAt' => $data['accessedAt'] ?? null,
                'modifiedAt' => $data['modifiedAt'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
