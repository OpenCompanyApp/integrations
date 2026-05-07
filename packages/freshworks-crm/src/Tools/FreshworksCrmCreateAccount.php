<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Create a Freshworks CRM sales account.
 */
class FreshworksCrmCreateAccount extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_create_account';
    protected string $toolDescription = 'Create a Freshworks CRM sales account.';
    protected string $method = 'POST';
    protected string $path = '/api/sales_accounts';
    protected string $bodyRoot = 'sales_account';
    protected array $required = ['name'];
    protected array $bodyParams = ['name', 'address', 'city', 'state', 'zipcode', 'country', 'website', 'phone', 'owner_id', 'industry_type_id', 'business_type_id', 'custom_field'];
    protected array $parameters = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Account name.'],
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
