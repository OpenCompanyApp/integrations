<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Manually change an Incident's Impact on a Business Service..
 *
 * Generated PagerDuty REST API tool for PUT /incidents/{id}/business_services/{business_service_id}/impacts.
 */
class PagerdutyPutIncidentManualBusinessServiceAssociation extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_put_incident_manual_business_service_association';
}