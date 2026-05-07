<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Get raw incidents for a single responder_id.
 *
 * Generated PagerDuty REST API tool for POST /analytics/raw/responders/{responder_id}/incidents.
 */
class PagerdutyGetAnalyticsResponderIncidents extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_get_analytics_responder_incidents';
}