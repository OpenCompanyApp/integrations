<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * List Freshworks CRM sales activities.
 */
class FreshworksCrmListSalesActivities extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_list_sales_activities';
    protected string $toolDescription = 'List Freshworks CRM sales activities.';
    protected string $path = '/api/sales_activities';
    protected array $queryParams = ['page', 'per_page', 'include'];
    protected array $parameters = [
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Results per page.'],
        'include' => ['type' => 'string', 'description' => 'Comma-separated include list.'],
    ];
}
