<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\Integrations\Tapfiliate\TapfiliateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Tapfiliate conversion.
 *
 * Tracks a conversion by referral code, click/tracking ids, coupon, customer id, or explicit attribution fields.
 */
class TapfiliateCreateConversion implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_create_conversion';
    }

    public function description(): string
    {
        return 'Create a new conversion in Tapfiliate. Associates a revenue amount with an affiliate using a unique external ID (e.g., order ID or transaction reference).';
    }

    public function parameters(): array
    {
        return [
            'affiliate_id' => ['type' => 'string', 'description' => 'The ID of the affiliate to credit when known.'],
            'referral_code' => ['type' => 'string', 'description' => 'Affiliate referral code, matching the ref= value in referral links.'],
            'tracking_id' => ['type' => 'string', 'description' => 'Tracking id from Tapfiliate.js.'],
            'click_id' => ['type' => 'string', 'description' => 'Click id for additional reporting.'],
            'coupon' => ['type' => 'string', 'description' => 'Coupon code to attribute the conversion.'],
            'amount' => ['type' => 'number', 'description' => 'The conversion amount (e.g., 29.99).'],
            'external_id' => ['type' => 'string', 'required' => true, 'description' => 'A unique external reference (e.g., order ID, transaction ID).'],
            'program_id' => ['type' => 'string', 'description' => 'Program ID.'],
            'currency' => ['type' => 'string', 'description' => 'Three-letter ISO currency code.'],
            'customer_id' => ['type' => 'string', 'description' => 'Customer id for recurring or lifetime commission workflows.'],
            'commission_type' => ['type' => 'string', 'description' => 'Commission type id.'],
            'commissions' => ['type' => 'array', 'description' => 'Commission override array. Overrides amount and commission_type when supplied.'],
            'meta_data' => ['type' => 'object', 'description' => 'Optional key-value metadata to attach to the conversion.'],
        ];
    }

    /**
     * Create a conversion.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            $externalId = $args['external_id'] ?? '';

            if (empty($externalId)) {
                return ToolResult::error('external_id is required.');
            }

            $params = ['external_id' => $externalId];
            $optionalKeys = ['affiliate_id', 'referral_code', 'tracking_id', 'click_id', 'coupon', 'amount', 'program_id', 'currency', 'customer_id', 'commission_type', 'commissions', 'meta_data'];

            foreach ($optionalKeys as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->createConversion($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
