<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * List notes for a Tapfiliate affiliate.
 *
 * Returns the notes collection attached to an affiliate profile.
 */
class TapfiliateListAffiliateNotes implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_list_affiliate_notes';
    }

    public function description(): string
    {
        return 'List notes attached to a Tapfiliate affiliate.';
    }

    public function parameters(): array
    {
        return [
            'affiliate_id' => ['type' => 'string', 'required' => true, 'description' => 'Affiliate ID.'],
        ];
    }

    /**
     * List affiliate notes.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            return ToolResult::success($this->service->listAffiliateNotes((string) ($args['affiliate_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
