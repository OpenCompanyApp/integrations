<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Retrieve one Appwrite team.
 */
class AppwriteGetTeam extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_get_team';
    protected string $toolDescription = 'Get one Appwrite team by ID.';
    protected string $path = '/teams/{team_id}';
    protected array $required = ['team_id'];
    protected array $parameters = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
    ];
}
