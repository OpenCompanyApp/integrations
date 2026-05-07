<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * List Tapfiliate commissions.
 *
 * Supports common commission filters for reconciliation and affiliate reporting.
 */
class TapfiliateListCommissions implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_list_commissions';
    }

    public function description(): string
    {
        return 'List Tapfiliate commissions with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'affiliate_id' => ['type' => 'string', 'description' => 'Filter by affiliate ID.'],
            'conversion_id' => ['type' => 'string', 'description' => 'Filter by conversion ID.'],
            'program_id' => ['type' => 'string', 'description' => 'Filter by program ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by commission status.'],
            'date_from' => ['type' => 'string', 'description' => 'Start date filter.'],
            'date_to' => ['type' => 'string', 'description' => 'End date filter.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'limit' => ['type' => 'integer', 'description' => 'Page size.'],
        ];
    }

    /**
     * List commissions.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            $filters = [];
            foreach (['affiliate_id', 'conversion_id', 'program_id', 'status', 'date_from', 'date_to', 'page', 'limit'] as $key) {
                if (isset($args[$key]) && $args[$key] !== '') {
                    $filters[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->listCommissions($filters));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
