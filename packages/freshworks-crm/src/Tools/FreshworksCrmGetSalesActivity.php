<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Fetch a Freshworks CRM sales activity.
 */
class FreshworksCrmGetSalesActivity extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_get_sales_activity';
    protected string $toolDescription = 'Get a Freshworks CRM sales activity by ID.';
    protected string $path = '/api/sales_activities/{id}';
    protected array $required = ['id'];
    protected array $queryParams = ['include'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Sales activity ID.'],
        'include' => ['type' => 'string', 'description' => 'Comma-separated include list.'],
    ];
}
