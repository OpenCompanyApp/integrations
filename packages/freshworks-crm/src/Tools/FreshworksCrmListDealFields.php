<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * List Freshworks CRM deal fields.
 */
class FreshworksCrmListDealFields extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_list_deal_fields';
    protected string $toolDescription = 'List Freshworks CRM deal fields.';
    protected string $path = '/api/settings/deals/fields';
}
