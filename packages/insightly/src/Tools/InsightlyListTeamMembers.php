<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly team members.
 */
class InsightlyListTeamMembers extends InsightlyListUsers
{
    protected string $toolName = 'insightly_list_team_members';
    protected string $toolDescription = 'List Insightly team members.';
    protected string $path = '/v3.1/TeamMembers';
}
