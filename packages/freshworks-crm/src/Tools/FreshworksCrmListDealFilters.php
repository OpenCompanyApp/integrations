<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * List Freshworks CRM deal filters.
 */
class FreshworksCrmListDealFilters extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_list_deal_filters';
    protected string $toolDescription = 'List saved deal filters.';
    protected string $path = '/api/deals/filters';
}
