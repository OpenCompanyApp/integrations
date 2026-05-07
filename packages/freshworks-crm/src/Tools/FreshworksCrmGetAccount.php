<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Fetch a Freshworks CRM sales account.
 */
class FreshworksCrmGetAccount extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_get_account';
    protected string $toolDescription = 'Get a Freshworks CRM sales account by ID.';
    protected string $path = '/api/sales_accounts/{id}';
    protected array $required = ['id'];
    protected array $queryParams = ['include'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Sales account ID.'],
        'include' => ['type' => 'string', 'description' => 'Comma-separated include list.'],
    ];
}
