<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * List the supporting Business Services for the given Business Service Id, sorted by impacted status..
 *
 * Generated PagerDuty REST API tool for GET /business_services/{id}/supporting_services/impacts.
 */
class PagerdutyGetBusinessServiceSupportingServiceImpacts extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_get_business_service_supporting_service_impacts';
}