<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Remove an escalation policy from a team.
 *
 * Generated PagerDuty REST API tool for DELETE /teams/{id}/escalation_policies/{escalation_policy_id}.
 */
class PagerdutyDeleteTeamEscalationPolicy extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_delete_team_escalation_policy';
}