<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * Set a Tapfiliate affiliate's group.
 *
 * Assigns the affiliate group used for program segmentation and commission rules.
 */
class TapfiliateSetAffiliateGroup implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_set_affiliate_group';
    }

    public function description(): string
    {
        return 'Assign an affiliate to a Tapfiliate affiliate group.';
    }

    public function parameters(): array
    {
        return [
            'affiliate_id' => ['type' => 'string', 'required' => true, 'description' => 'Affiliate ID.'],
            'group_id' => ['type' => 'string', 'required' => true, 'description' => 'Affiliate group ID.'],
        ];
    }

    /**
     * Set affiliate group.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            return ToolResult::success($this->service->setAffiliateGroup((string) ($args['affiliate_id'] ?? ''), (string) ($args['group_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
