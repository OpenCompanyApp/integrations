<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * Create an Insightly team.
 */
class InsightlyCreateTeam extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_create_team';
    protected string $toolDescription = 'Create an Insightly team.';
    protected string $method = 'POST';
    protected string $path = '/v3.1/Teams';
    protected array $required = ['TEAM_NAME'];
    protected array $bodyParams = ['TEAM_NAME', 'TEAMMEMBERS'];
    protected array $parameters = [
        'TEAM_NAME' => ['type' => 'string', 'required' => true, 'description' => 'Team name.'],
        'TEAMMEMBERS' => ['type' => 'array', 'description' => 'Initial team member records.'],
    ];
}
