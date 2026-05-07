<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Disassociate a runner from a team.
 *
 * Generated PagerDuty REST API tool for DELETE /automation_actions/runners/{id}/teams/{team_id}.
 */
class PagerdutyDeleteAutomationActionsRunnerTeamAssociation extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_delete_automation_actions_runner_team_association';
}