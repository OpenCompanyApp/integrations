<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Delete a User's Handoff Notification rule.
 *
 * Generated PagerDuty REST API tool for DELETE /users/{id}/oncall_handoff_notification_rules/{oncall_handoff_notification_rule_id}.
 */
class PagerdutyDeleteUserHandoffNotificationRule extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_delete_user_handoff_notification_rule';
}