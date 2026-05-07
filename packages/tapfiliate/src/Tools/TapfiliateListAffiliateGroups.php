<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * List Tapfiliate affiliate groups.
 *
 * Returns configured affiliate groups for segmentation and commission workflows.
 */
class TapfiliateListAffiliateGroups implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_list_affiliate_groups';
    }

    public function description(): string
    {
        return 'List all Tapfiliate affiliate groups.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List affiliate groups.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            return ToolResult::success($this->service->listAffiliateGroups());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
