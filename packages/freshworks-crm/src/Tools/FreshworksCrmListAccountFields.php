<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * List Freshworks CRM sales account fields.
 */
class FreshworksCrmListAccountFields extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_list_account_fields';
    protected string $toolDescription = 'List Freshworks CRM sales account fields.';
    protected string $path = '/api/settings/sales_accounts/fields';
}
