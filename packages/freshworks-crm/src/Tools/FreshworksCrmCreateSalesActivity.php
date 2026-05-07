<?php

namespace OpenCompany\Integrations\FreshworksCrm\Tools;

/**
 * Create a Freshworks CRM sales activity.
 */
class FreshworksCrmCreateSalesActivity extends AbstractFreshworksCrmModuleTool
{
    protected string $toolName = 'freshworks_crm_create_sales_activity';
    protected string $toolDescription = 'Create a Freshworks CRM sales activity.';
    protected string $method = 'POST';
    protected string $path = '/api/sales_activities';
    protected string $bodyRoot = 'sales_activity';
    protected array $required = ['title'];
    protected array $bodyParams = ['title', 'description', 'start_date', 'end_date', 'owner_id', 'targetable_id', 'targetable_type', 'custom_field'];
    protected array $parameters = [
        'title' => ['type' => 'string', 'required' => true, 'description' => 'Sales activity title.'],
        'description' => ['type' => 'string', 'description' => 'Description.'],
        'start_date' => ['type' => 'string', 'description' => 'Start date/time.'],
        'end_date' => ['type' => 'string', 'description' => 'End date/time.'],
        'owner_id' => ['type' => 'integer', 'description' => 'Owner user ID.'],
        'targetable_id' => ['type' => 'integer', 'description' => 'Related record ID.'],
        'targetable_type' => ['type' => 'string', 'description' => 'Related record type.'],
        'custom_field' => ['type' => 'object', 'description' => 'Custom field values.'],
    ];
}
