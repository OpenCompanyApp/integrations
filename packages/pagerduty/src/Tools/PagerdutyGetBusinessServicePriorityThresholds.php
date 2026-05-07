<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Get the global priority threshold for a Business Service to be considered impacted by an Incident.
 *
 * Generated PagerDuty REST API tool for GET /business_services/priority_thresholds.
 */
class PagerdutyGetBusinessServicePriorityThresholds extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_get_business_service_priority_thresholds';
}