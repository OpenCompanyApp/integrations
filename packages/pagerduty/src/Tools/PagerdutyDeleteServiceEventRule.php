<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Delete an Event Rule from a Service.
 *
 * Generated PagerDuty REST API tool for DELETE /services/{id}/rules/{rule_id}.
 */
class PagerdutyDeleteServiceEventRule extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_delete_service_event_rule';
}