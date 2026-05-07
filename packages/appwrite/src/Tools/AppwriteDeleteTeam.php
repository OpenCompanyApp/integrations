<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * Delete an Appwrite team.
 */
class AppwriteDeleteTeam extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_delete_team';
    protected string $toolDescription = 'Delete a team from the current Appwrite project.';
    protected string $method = 'DELETE';
    protected string $path = '/teams/{team_id}';
    protected array $required = ['team_id'];
    protected array $parameters = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
    ];
}
