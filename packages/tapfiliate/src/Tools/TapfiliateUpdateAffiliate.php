<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * Update a Tapfiliate affiliate.
 *
 * Sends partial affiliate profile changes to the affiliate resource.
 */
class TapfiliateUpdateAffiliate implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_update_affiliate';
    }

    public function description(): string
    {
        return 'Update a Tapfiliate affiliate profile, company, address, or custom field data.';
    }

    public function parameters(): array
    {
        return [
            'affiliate_id' => ['type' => 'string', 'required' => true, 'description' => 'Affiliate ID to update.'],
            'firstname' => ['type' => 'string', 'description' => 'Affiliate first name.'],
            'lastname' => ['type' => 'string', 'description' => 'Affiliate last name.'],
            'email' => ['type' => 'string', 'description' => 'Affiliate email address.'],
            'company' => ['type' => 'object', 'description' => 'Company object.'],
            'address' => ['type' => 'object', 'description' => 'Address object.'],
            'custom_fields' => ['type' => 'object', 'description' => 'Custom field values.'],
        ];
    }

    /**
     * Update an affiliate.
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

            return ToolResult::success($this->service->updateAffiliate($affiliateId, $this->params($args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments
     * @return array<string, mixed>
     */
    private function params(array $args): array
    {
        return array_intersect_key($args, array_flip(['firstname', 'lastname', 'email', 'company', 'address', 'custom_fields']));
    }
}
