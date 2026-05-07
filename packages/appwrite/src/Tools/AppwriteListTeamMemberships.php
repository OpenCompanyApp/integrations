<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * List memberships for an Appwrite team.
 */
class AppwriteListTeamMemberships extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_list_team_memberships';
    protected string $toolDescription = 'List memberships for a team.';
    protected string $path = '/teams/{team_id}/memberships';
    protected array $required = ['team_id'];
    protected array $queryParams = ['queries', 'search'];
    protected array $parameters = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
        'queries' => ['type' => 'array', 'description' => 'Appwrite Query strings for filtering and pagination.', 'items' => ['type' => 'string']],
        'search' => ['type' => 'string', 'description' => 'Search term for memberships.'],
    ];
}
