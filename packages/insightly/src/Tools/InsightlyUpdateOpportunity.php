<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Update an Insightly opportunity.
 */
class InsightlyUpdateOpportunity extends InsightlyCreateOpportunity
{
    protected string $toolName = 'insightly_update_opportunity';
    protected string $toolDescription = 'Update an Insightly opportunity.';
    protected string $method = 'PUT';
    protected string $path = '/v3.1/Opportunities';
    protected array $required = ['id'];
    protected array $bodyParams = ['id' => 'OPPORTUNITY_ID', 'OPPORTUNITY_NAME', 'OPPORTUNITY_DETAILS', 'BID_AMOUNT', 'BID_CURRENCY', 'BID_TYPE', 'CATEGORY_ID', 'PIPELINE_ID', 'STAGE_ID', 'RESPONSIBLE_USER_ID', 'OPPORTUNITY_STATE', 'FORECAST_CLOSE_DATE', 'CUSTOMFIELDS', 'LINKS'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly opportunity ID.'],
        'OPPORTUNITY_NAME' => ['type' => 'string', 'description' => 'Opportunity name.'],
        'OPPORTUNITY_DETAILS' => ['type' => 'string', 'description' => 'Opportunity details.'],
        'BID_AMOUNT' => ['type' => 'number', 'description' => 'Bid amount.'],
        'BID_CURRENCY' => ['type' => 'string', 'description' => 'Currency code.'],
        'BID_TYPE' => ['type' => 'string', 'description' => 'Bid type.'],
        'CATEGORY_ID' => ['type' => 'integer', 'description' => 'Category ID.'],
        'PIPELINE_ID' => ['type' => 'integer', 'description' => 'Pipeline ID.'],
        'STAGE_ID' => ['type' => 'integer', 'description' => 'Pipeline stage ID.'],
        'RESPONSIBLE_USER_ID' => ['type' => 'integer', 'description' => 'Responsible user ID.'],
        'OPPORTUNITY_STATE' => ['type' => 'string', 'description' => 'Opportunity state.'],
        'FORECAST_CLOSE_DATE' => ['type' => 'string', 'description' => 'Forecast close date.'],
        'CUSTOMFIELDS' => ['type' => 'array', 'description' => 'Custom field values.'],
        'LINKS' => ['type' => 'array', 'description' => 'Relationship links.'],
    ];
}
