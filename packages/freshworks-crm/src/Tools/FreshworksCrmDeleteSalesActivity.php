<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Delete a Freshworks CRM sales activity.
 */
class FreshworksCrmDeleteSalesActivity extends AbstractFreshworksCrmEndpointTool
{
    protected string $toolName = 'freshworks_crm_delete_sales_activity';
    protected string $toolDescription = 'Delete a Freshworks CRM sales activity.';
    protected string $method = 'DELETE';
    protected string $path = '/api/sales_activities/{id}';
    protected array $required = ['id'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Sales activity ID to delete.'],
    ];
}
