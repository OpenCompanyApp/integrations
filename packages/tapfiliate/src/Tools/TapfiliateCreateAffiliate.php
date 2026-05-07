<?php

namespace OpenCompany\Integrations\Tapfiliate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tapfiliate\TapfiliateService;

/**
 * Create a Tapfiliate affiliate.
 *
 * Sends the documented affiliate profile fields to the affiliates collection.
 */
class TapfiliateCreateAffiliate implements Tool
{
    /**
     * @param  TapfiliateService  $service  The Tapfiliate API client
     */
    public function __construct(
        private TapfiliateService $service,
    ) {}

    public function name(): string
    {
        return 'tapfiliate_create_affiliate';
    }

    public function description(): string
    {
        return 'Create a Tapfiliate affiliate with profile, company, address, and custom field data.';
    }

    public function parameters(): array
    {
        return [
            'firstname' => ['type' => 'string', 'required' => true, 'description' => 'Affiliate first name.'],
            'lastname' => ['type' => 'string', 'required' => true, 'description' => 'Affiliate last name.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Affiliate email address.'],
            'password' => ['type' => 'string', 'description' => 'Optional affiliate portal password.'],
            'company' => ['type' => 'object', 'description' => 'Company object, for example {name: "..."}'],
            'address' => ['type' => 'object', 'description' => 'Address object with address, postal_code, city, state, and country code.'],
            'custom_fields' => ['type' => 'object', 'description' => 'Custom field values.'],
        ];
    }

    /**
     * Create an affiliate.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Tapfiliate integration is not configured.');
            }

            foreach (['firstname', 'lastname', 'email'] as $required) {
                if (empty($args[$required])) {
                    return ToolResult::error("{$required} is required.");
                }
            }

            return ToolResult::success($this->service->createAffiliate($this->params($args)));
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
        return array_intersect_key($args, array_flip(['firstname', 'lastname', 'email', 'password', 'company', 'address', 'custom_fields']));
    }
}
