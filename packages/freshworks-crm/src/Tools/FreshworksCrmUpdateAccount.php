<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Update a Freshworks CRM sales account.
 */
class FreshworksCrmUpdateAccount extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_update_account';
    protected string $toolDescription = 'Update a Freshworks CRM sales account.';
    protected string $method = 'PUT';
    protected string $path = '/api/sales_accounts/{id}';
    protected string $bodyRoot = 'sales_account';
    protected array $required = ['id'];
    protected array $bodyParams = ['name', 'address', 'city', 'state', 'zipcode', 'country', 'website', 'phone', 'owner_id', 'industry_type_id', 'business_type_id', 'custom_field'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Sales account ID.'],
        'name' => ['type' => 'string', 'description' => 'Account name.'],
        'address' => ['type' => 'string', 'description' => 'Address.'],
        'city' => ['type' => 'string', 'description' => 'City.'],
        'state' => ['type' => 'string', 'description' => 'State.'],
        'zipcode' => ['type' => 'string', 'description' => 'Postal code.'],
        'country' => ['type' => 'string', 'description' => 'Country.'],
        'website' => ['type' => 'string', 'description' => 'Website URL.'],
        'phone' => ['type' => 'string', 'description' => 'Phone number.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'industry_type_id' => ['type' => 'integer', 'description' => 'Industry type ID.'],
        'business_type_id' => ['type' => 'integer', 'description' => 'Business type ID.'],
        'custom_field' => ['type' => 'object', 'description' => 'Custom field values.'],
    ];
}
