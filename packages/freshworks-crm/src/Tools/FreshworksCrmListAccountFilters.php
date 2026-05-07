<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * List Freshworks CRM sales account filters.
 */
class FreshworksCrmListAccountFilters extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_list_account_filters';
    protected string $toolDescription = 'List saved sales account filters.';
    protected string $path = '/api/sales_accounts/filters';
}
