<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Add an escalation policy to a team.
 *
 * Generated PagerDuty REST API tool for PUT /teams/{id}/escalation_policies/{escalation_policy_id}.
 */
class PagerdutyUpdateTeamEscalationPolicy extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_update_team_escalation_policy';
}