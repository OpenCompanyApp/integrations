<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Update a Freshworks CRM sales activity.
 */
class FreshworksCrmUpdateSalesActivity extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_update_sales_activity';
    protected string $toolDescription = 'Update a Freshworks CRM sales activity.';
    protected string $method = 'PUT';
    protected string $path = '/api/sales_activities/{id}';
    protected string $bodyRoot = 'sales_activity';
    protected array $required = ['id'];
    protected array $bodyParams = ['title', 'description', 'start_date', 'end_date', 'owner_id', 'targetable_id', 'targetable_type', 'custom_field'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Sales activity ID.'],
        'title' => ['type' => 'string', 'description' => 'Sales activity title.'],
        'description' => ['type' => 'string', 'description' => 'Description.'],
        'start_date' => ['type' => 'string', 'description' => 'Start date/time.'],
        'end_date' => ['type' => 'string', 'description' => 'End date/time.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'targetable_id' => ['type' => 'integer', 'description' => 'Related record ID.'],
        'targetable_type' => ['type' => 'string', 'description' => 'Related record type.'],
        'custom_field' => ['type' => 'object', 'description' => 'Custom field values.'],
    ];
}
