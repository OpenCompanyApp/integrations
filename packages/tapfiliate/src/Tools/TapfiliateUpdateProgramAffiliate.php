<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * Update a program affiliate record.
 *
 * Supports updating program-affiliate fields such as assigned coupon code.
 */
class TapfiliateUpdateProgramAffiliate implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_update_program_affiliate';
    }

    public function description(): string
    {
        return 'Update an affiliate enrollment within a Tapfiliate program.';
    }

    public function parameters(): array
    {
        return [
            'program_id' => ['type' => 'string', 'required' => true, 'description' => 'Program ID.'],
            'affiliate_id' => ['type' => 'string', 'required' => true, 'description' => 'Affiliate ID.'],
            'coupon' => ['type' => 'string', 'description' => 'Coupon code to assign to the affiliate in this program.'],
        ];
    }

    /**
     * Update program affiliate.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            $params = array_intersect_key($args, array_flip(['coupon']));

            return ToolResult::success($this->service->updateProgramAffiliate((string) ($args['program_id'] ?? ''), (string) ($args['affiliate_id'] ?? ''), $params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
