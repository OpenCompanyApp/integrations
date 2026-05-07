<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * List Freshworks CRM sales activity fields.
 */
class FreshworksCrmListSalesActivityFields extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_list_sales_activity_fields';
    protected string $toolDescription = 'List Freshworks CRM sales activity fields.';
    protected string $path = '/api/settings/sales_activities/fields';
}
