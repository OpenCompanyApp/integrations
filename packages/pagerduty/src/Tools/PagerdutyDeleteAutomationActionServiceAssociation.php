<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Disassociate an Automation Action from a service.
 *
 * Generated PagerDuty REST API tool for DELETE /automation_actions/actions/{id}/services/{service_id}.
 */
class PagerdutyDeleteAutomationActionServiceAssociation extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_delete_automation_action_service_association';
}