<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Remove a user from a team.
 *
 * Generated PagerDuty REST API tool for DELETE /teams/{id}/users/{user_id}.
 */
class PagerdutyDeleteTeamUser extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_delete_team_user';
}