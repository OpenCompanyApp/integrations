<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly teams.
 */
class InsightlyListTeams extends InsightlyListUsers
{
    protected string $toolName = 'insightly_list_teams';
    protected string $toolDescription = 'List Insightly teams.';
    protected string $path = '/v3.1/Teams';
}
