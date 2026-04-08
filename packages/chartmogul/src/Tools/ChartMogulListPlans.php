<?php

namespace OpenCompany\Integrations\ChartMogul\Tools;

use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChartMogulListPlans implements Tool
{
    public function __construct(
        private ChartMogulService $service,
    ) {}

    public function name(): string
    {
        return 'chartmogul_list_plans';
    }

    public function description(): string
    {
        return 'List billing plans from ChartMogul. Returns plan details including name, interval, amount, and currency.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50, max: 200).'],
            'page' => ['type' => 'integer', 'description' => 'Page number, starting from 1 (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChartMogul integration is not configured.');
            }

            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 50;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listPlans($perPage, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
