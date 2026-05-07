<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * Delete a Tapfiliate affiliate.
 *
 * Removes an affiliate by id using the documented delete endpoint.
 */
class TapfiliateDeleteAffiliate implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_delete_affiliate';
    }

    public function description(): string
    {
        return 'Delete a Tapfiliate affiliate by ID.';
    }

    public function parameters(): array
    {
        return [
            'affiliate_id' => ['type' => 'string', 'required' => true, 'description' => 'Affiliate ID to delete.'],
        ];
    }

    /**
     * Delete an affiliate.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            $affiliateId = (string) ($args['affiliate_id'] ?? '');
            if ($affiliateId === '') {
                return ToolResult::error('affiliate_id is required.');
            }

            return ToolResult::success($this->service->deleteAffiliate($affiliateId));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
