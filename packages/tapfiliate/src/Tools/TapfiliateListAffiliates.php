<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\Integrations\Tapfiliate\TapfiliateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Tapfiliate affiliates.
 *
 * Supports documented filters such as email, referral code, click/source ids, parent id, and affiliate group id.
 */
class TapfiliateListAffiliates implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_list_affiliates';
    }

    public function description(): string
    {
        return 'List affiliates in your Tapfiliate account. Returns paginated results with affiliate IDs, emails, names, and status.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of affiliates per page (default: 25, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'email' => ['type' => 'string', 'description' => 'Filter by email address.'],
            'referral_code' => ['type' => 'string', 'description' => 'Filter by affiliate referral code.'],
            'click_id' => ['type' => 'string', 'description' => 'Filter by click id.'],
            'source_id' => ['type' => 'string', 'description' => 'Filter by source id.'],
            'parent_id' => ['type' => 'string', 'description' => 'Retrieve children for a parent affiliate.'],
            'affiliate_group_id' => ['type' => 'string', 'description' => 'Filter by affiliate group id.'],
        ];
    }

    /**
     * List affiliates.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            $filters = [];
            foreach (['limit', 'page', 'email', 'referral_code', 'click_id', 'source_id', 'parent_id', 'affiliate_group_id'] as $key) {
                if (isset($args[$key]) && $args[$key] !== '') {
                    $filters[$key] = $args[$key];
                }
            }

            $result = $this->service->listAffiliates($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
