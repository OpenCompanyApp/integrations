<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Update a Freshworks CRM deal.
 */
class FreshworksCrmUpdateDeal extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_update_deal';
    protected string $toolDescription = 'Update a Freshworks CRM deal.';
    protected string $method = 'PUT';
    protected string $path = '/api/deals/{id}';
    protected string $bodyRoot = 'deal';
    protected array $required = ['id'];
    protected array $bodyParams = ['name', 'amount', 'base_currency_amount', 'expected_close', 'deal_stage_id', 'deal_pipeline_id', 'sales_account_id', 'contact_ids', 'owner_id', 'probability', 'custom_field', 'products'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Deal ID.'],
        'name' => ['type' => 'string', 'description' => 'Deal name.'],
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
