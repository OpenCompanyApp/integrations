<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * Create a Tapfiliate customer.
 *
 * Tracks a customer for recurring and lifetime commission attribution.
 */
class TapfiliateCreateCustomer implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_create_customer';
    }

    public function description(): string
    {
        return 'Create or track a Tapfiliate customer for recurring and lifetime commission workflows.';
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'Unique customer ID in your system.'],
            'referral_code' => ['type' => 'string', 'description' => 'Affiliate referral code.'],
            'tracking_id' => ['type' => 'string', 'description' => 'Tracking id from Tapfiliate.js.'],
            'click_id' => ['type' => 'string', 'description' => 'Click id.'],
            'coupon' => ['type' => 'string', 'description' => 'Coupon code.'],
            'status' => ['type' => 'string', 'description' => 'Initial customer status. Defaults to new upstream.'],
            'program_id' => ['type' => 'string', 'description' => 'Program ID.'],
            'meta_data' => ['type' => 'object', 'description' => 'Optional metadata.'],
        ];
    }

    /**
     * Create a customer.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }
            if (empty($args['customer_id'])) {
                return ToolResult::error('customer_id is required.');
            }

            return ToolResult::success($this->service->createCustomer(array_intersect_key($args, array_flip(['customer_id', 'referral_code', 'tracking_id', 'click_id', 'coupon', 'status', 'program_id', 'meta_data']))));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
