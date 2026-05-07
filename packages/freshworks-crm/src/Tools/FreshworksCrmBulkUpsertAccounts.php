<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Bulk upsert Freshworks CRM sales accounts.
 */
class FreshworksCrmBulkUpsertAccounts extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_bulk_upsert_accounts';
    protected string $toolDescription = 'Bulk upsert Freshworks CRM sales accounts.';
    protected string $method = 'POST';
    protected string $path = '/api/sales_accounts/bulk_upsert';
    protected array $required = ['sales_accounts'];
    protected array $bodyParams = ['sales_accounts', 'unique_identifier'];
    protected array $parameters = [
        'sales_accounts' => ['type' => 'array', 'required' => true, 'description' => 'Sales account payloads.'],
        'unique_identifier' => ['type' => 'string', 'description' => 'Unique identifier field.'],
    ];
}
