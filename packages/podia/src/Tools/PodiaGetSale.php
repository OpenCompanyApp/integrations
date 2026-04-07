<?php

namespace OpenCompany\Integrations\Podia\Tools;

use OpenCompany\Integrations\Podia\PodiaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PodiaGetSale implements Tool
{
    public function __construct(
        private PodiaService $service,
    ) {}

    public function name(): string
    {
        return 'podia_get_sale';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Podia sale by its ID. Returns full sale data including buyer details, amount, product, and payment status.';
    }

    public function parameters(): array
    {
        return [
            'sale_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the sale to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Podia integration is not configured.');
            }

            if (empty($args['sale_id'])) {
                return ToolResult::error('sale_id is required.');
            }

            $result = $this->service->getSale($args['sale_id']);

            $sale = $result['sale'] ?? $result;

            return ToolResult::success($sale);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
