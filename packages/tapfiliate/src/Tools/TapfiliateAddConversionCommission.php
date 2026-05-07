<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * Add a commission line to a Tapfiliate conversion.
 *
 * Calculates and creates a commission using a conversion sub-amount and optional commission type.
 */
class TapfiliateAddConversionCommission implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_add_conversion_commission';
    }

    public function description(): string
    {
        return 'Add a commission line to a Tapfiliate conversion.';
    }

    public function parameters(): array
    {
        return [
            'conversion_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversion ID.'],
            'conversion_sub_amount' => ['type' => 'number', 'required' => true, 'description' => 'Amount on which commission should be calculated.'],
            'commission_type' => ['type' => 'string', 'description' => 'Optional commission type id.'],
            'comment' => ['type' => 'string', 'description' => 'Optional affiliate-visible comment.'],
        ];
    }

    /**
     * Add a commission to a conversion.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            $conversionId = (string) ($args['conversion_id'] ?? '');
            if ($conversionId === '' || ! isset($args['conversion_sub_amount'])) {
                return ToolResult::error('conversion_id and conversion_sub_amount are required.');
            }

            $params = ['conversion_sub_amount' => $args['conversion_sub_amount']];
            foreach (['commission_type', 'comment'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->addConversionCommission($conversionId, $params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
