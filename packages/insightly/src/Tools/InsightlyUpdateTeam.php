<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Update an Insightly team.
 */
class InsightlyUpdateTeam extends InsightlyCreateTeam
{
    protected string $toolName = 'insightly_update_team';
    protected string $toolDescription = 'Update an Insightly team.';
    protected string $method = 'PUT';
    protected string $path = '/v3.1/Teams';
    protected array $required = ['id'];
    protected array $bodyParams = ['id' => 'TEAM_ID', 'TEAM_NAME', 'TEAMMEMBERS'];
    protected array $parameters = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Insightly team ID.'],
        'TEAM_NAME' => ['type' => 'string', 'description' => 'Team name.'],
        'TEAMMEMBERS' => ['type' => 'array', 'description' => 'Team member records.'],
    ];
}
