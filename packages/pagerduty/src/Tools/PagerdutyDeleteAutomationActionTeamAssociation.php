<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Disassociate an Automation Action from a team.
 *
 * Generated PagerDuty REST API tool for DELETE /automation_actions/actions/{id}/teams/{team_id}.
 */
class PagerdutyDeleteAutomationActionTeamAssociation extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_delete_automation_action_team_association';
}