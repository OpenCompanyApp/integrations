<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * List Business Services impacted by the given Incident.
 *
 * Generated PagerDuty REST API tool for GET /incidents/{id}/business_services/impacts.
 */
class PagerdutyGetIncidentImpactedBusinessServices extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_get_incident_impacted_business_services';
}