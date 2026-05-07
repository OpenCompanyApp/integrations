<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Create an Insightly lead.
 */
class InsightlyCreateLead extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_create_lead';
    protected string $toolDescription = 'Create an Insightly lead.';
    protected string $method = 'POST';
    protected string $path = '/v3.1/Leads';
    protected array $required = ['FIRST_NAME', 'LAST_NAME'];
    protected array $bodyParams = ['FIRST_NAME', 'LAST_NAME', 'ORGANIZATION_NAME', 'TITLE', 'EMAIL', 'PHONE', 'MOBILE', 'LEAD_SOURCE_ID', 'LEAD_STATUS_ID', 'RESPONSIBLE_USER_ID', 'CUSTOMFIELDS', 'ADDRESS'];
    protected array $parameters = [
        'FIRST_NAME' => ['type' => 'string', 'required' => true, 'description' => 'Lead first name.'],
        'LAST_NAME' => ['type' => 'string', 'required' => true, 'description' => 'Lead last name.'],
        'ORGANIZATION_NAME' => ['type' => 'string', 'description' => 'Organization name.'],
        'TITLE' => ['type' => 'string', 'description' => 'Lead title.'],
        'EMAIL' => ['type' => 'string', 'description' => 'Email address.'],
        'PHONE' => ['type' => 'string', 'description' => 'Phone number.'],
        'MOBILE' => ['type' => 'string', 'description' => 'Mobile number.'],
        'LEAD_SOURCE_ID' => ['type' => 'integer', 'description' => 'Lead source ID.'],
        'LEAD_STATUS_ID' => ['type' => 'integer', 'description' => 'Lead status ID.'],
        'RESPONSIBLE_USER_ID' => ['type' => 'integer', 'description' => 'Responsible user ID.'],
        'CUSTOMFIELDS' => ['type' => 'array', 'description' => 'Custom field values.'],
        'ADDRESS' => ['type' => 'object', 'description' => 'Address object.'],
    ];
}
