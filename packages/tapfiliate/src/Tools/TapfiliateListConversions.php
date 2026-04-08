<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\Integrations\Tapfiliate\TapfiliateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TapfiliateListConversions implements Tool
{
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_list_conversions';
    }

    public function description(): string
    {
        return 'List conversions in your Tapfiliate account. Supports filtering by affiliate, campaign, date range, and status. Results are paginated.';
    }

    public function parameters(): array
    {
        return [
            'affiliate_id' => ['type' => 'string', 'description' => 'Filter by affiliate ID.'],
            'campaign_id' => ['type' => 'string', 'description' => 'Filter by campaign ID.'],
            'external_id' => ['type' => 'string', 'description' => 'Filter by external ID (e.g., order or transaction ID).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "approved", "pending", or "rejected".'],
            'from_date' => ['type' => 'string', 'description' => 'Start date filter (ISO 8601, e.g., "2025-01-01").'],
            'to_date' => ['type' => 'string', 'description' => 'End date filter (ISO 8601, e.g., "2025-12-31").'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page (default: 25, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            $filters = [];
            $filterKeys = ['affiliate_id', 'campaign_id', 'external_id', 'status', 'from_date', 'to_date', 'limit', 'page'];

            foreach ($filterKeys as $key) {
                if (isset($args[$key]) && $args[$key] !== '') {
                    $filters[$key] = $args[$key];
                }
            }

            $result = $this->service->listConversions($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
