<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Create a Freshworks CRM deal.
 */
class FreshworksCrmCreateDeal extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_create_deal';
    protected string $toolDescription = 'Create a Freshworks CRM deal.';
    protected string $method = 'POST';
    protected string $path = '/api/deals';
    protected string $bodyRoot = 'deal';
    protected array $required = ['name'];
    protected array $bodyParams = ['name', 'amount', 'base_currency_amount', 'expected_close', 'deal_stage_id', 'deal_pipeline_id', 'sales_account_id', 'contact_ids', 'owner_id', 'probability', 'custom_field', 'products'];
    protected array $parameters = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Deal name.'],
        'amount' => ['type' => 'number', 'description' => 'Deal amount.'],
        'base_currency_amount' => ['type' => 'number', 'description' => 'Base currency amount.'],
        'expected_close' => ['type' => 'string', 'description' => 'Expected close date.'],
        'deal_stage_id' => ['type' => 'integer', 'description' => 'Deal stage ID.'],
        'deal_pipeline_id' => ['type' => 'integer', 'description' => 'Deal pipeline ID.'],
        'sales_account_id' => ['type' => 'integer', 'description' => 'Sales account ID.'],
        'contact_ids' => ['type' => 'array', 'description' => 'Associated contact IDs.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'probability' => ['type' => 'integer', 'description' => 'Deal probability.'],
        'custom_field' => ['type' => 'object', 'description' => 'Custom field values.'],
        'products' => ['type' => 'array', 'description' => 'Products associated with the deal.'],
    ];
}
