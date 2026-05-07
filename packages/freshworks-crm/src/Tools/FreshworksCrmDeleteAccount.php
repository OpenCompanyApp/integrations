<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Delete a Freshworks CRM sales account.
 */
class FreshworksCrmDeleteAccount extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_delete_account';
    protected string $toolDescription = 'Delete a Freshworks CRM sales account.';
    protected string $method = 'DELETE';
    protected string $path = '/api/sales_accounts/{id}';
    protected array $required = ['id'];
    protected array $queryParams = ['delete_associated_contacts_deals'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Sales account ID to delete.'],
        'delete_associated_contacts_deals' => ['type' => 'boolean', 'description' => 'Whether to delete associated contacts and deals.'],
    ];
}
