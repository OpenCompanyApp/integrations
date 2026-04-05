<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\Integrations\Tapfiliate\TapfiliateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TapfiliateCreateConversion implements Tool
{
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
            'affiliate_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the affiliate to credit.'],
            'amount' => ['type' => 'number', 'required' => true, 'description' => 'The conversion amount (e.g., 29.99).'],
            'external_id' => ['type' => 'string', 'required' => true, 'description' => 'A unique external reference (e.g., order ID, transaction ID).'],
            'campaign_id' => ['type' => 'string', 'description' => 'The campaign ID to associate the conversion with.'],
            'commission_type' => ['type' => 'string', 'description' => 'Commission type: "default" or "fixed".'],
            'commission_amount' => ['type' => 'number', 'description' => 'Override commission amount (if commission_type is "fixed").'],
            'meta_data' => ['type' => 'object', 'description' => 'Optional key-value metadata to attach to the conversion.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            $affiliateId = $args['affiliate_id'] ?? '';
            $amount = $args['amount'] ?? null;
            $externalId = $args['external_id'] ?? '';

            if (empty($affiliateId)) {
                return ToolResult::error('affiliate_id is required.');
            }
            if ($amount === null) {
                return ToolResult::error('amount is required.');
            }
            if (empty($externalId)) {
                return ToolResult::error('external_id is required.');
            }

            $options = [];
            $optionalKeys = ['campaign_id', 'commission_type', 'commission_amount', 'meta_data'];

            foreach ($optionalKeys as $key) {
                if (isset($args[$key])) {
                    $options[$key] = $args[$key];
                }
            }

            $result = $this->service->createConversion(
                affiliateId: $affiliateId,
                amount: (float) $amount,
                externalId: $externalId,
                options: $options,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
