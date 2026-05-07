<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * List Tapfiliate customers.
 *
 * Returns tracked customers used for recurring and lifetime commission workflows.
 */
class TapfiliateListCustomers implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_list_customers';
    }

    public function description(): string
    {
        return 'List Tapfiliate customers with optional program, customer, affiliate, and date filters.';
    }

    public function parameters(): array
    {
        return [
            'program_id' => ['type' => 'string', 'description' => 'Filter by program ID.'],
            'customer_id' => ['type' => 'string', 'description' => 'Filter by customer ID in your system.'],
            'affiliate_id' => ['type' => 'string', 'description' => 'Filter by affiliate ID.'],
            'date_from' => ['type' => 'string', 'description' => 'Start date filter.'],
            'date_to' => ['type' => 'string', 'description' => 'End date filter.'],
        ];
    }

    /**
     * List customers.
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
            foreach (['program_id', 'customer_id', 'affiliate_id', 'date_from', 'date_to'] as $key) {
                if (isset($args[$key]) && $args[$key] !== '') {
                    $filters[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->listCustomers($filters));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
