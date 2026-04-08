<?php

namespace OpenCompany\Integrations\MicrosoftPowerBI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MicrosoftPowerBI\PowerBIService;

class PowerBIGetDataset implements Tool
{
    public function __construct(
        private PowerBIService $service,
    ) {}

    public function name(): string
    {
        return 'powerbi_get_dataset';
    }

    public function description(): string
    {
        return 'Get details of a specific Power BI dataset by ID. Returns the dataset name, tables, default mode, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'dataset_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The unique ID of the Power BI dataset (GUID format).',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Power BI integration is not configured.');
            }

            $datasetId = $args['dataset_id'] ?? '';
            if (empty($datasetId)) {
                return ToolResult::error('dataset_id is required.');
            }

            $result = $this->service->getDataset($datasetId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
