<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Update a Freshworks CRM contact.
 */
class FreshworksCrmUpdateContact extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_update_contact';
    protected string $toolDescription = 'Update a Freshworks CRM contact.';
    protected string $method = 'PUT';
    protected string $path = '/api/contacts/{id}';
    protected string $bodyRoot = 'contact';
    protected array $required = ['id'];
    protected array $bodyParams = ['first_name', 'last_name', 'email', 'mobile_number', 'work_number', 'job_title', 'sales_account_id', 'owner_id', 'custom_field'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Contact ID.'],
        'first_name' => ['type' => 'string', 'description' => 'First name.'],
        'last_name' => ['type' => 'string', 'description' => 'Last name.'],
        'email' => ['type' => 'string', 'description' => 'Email address.'],
        'mobile_number' => ['type' => 'string', 'description' => 'Mobile number.'],
        'work_number' => ['type' => 'string', 'description' => 'Work number.'],
        'job_title' => ['type' => 'string', 'description' => 'Job title.'],
        'sales_account_id' => ['type' => 'integer', 'description' => 'Sales account ID.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'custom_field' => ['type' => 'object', 'description' => 'Custom field values.'],
    ];
}
