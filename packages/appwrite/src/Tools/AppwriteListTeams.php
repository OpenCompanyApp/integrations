<?php

namespace OpenCompany\Integrations\Appwrite\Tools;

/**
 * List Appwrite teams.
 */
class AppwriteListTeams extends AbstractAppwriteEndpointTool
{
    protected string $toolName = 'appwrite_list_teams';
    protected string $toolDescription = 'List teams in the current Appwrite project.';
    protected string $path = '/teams';
    protected array $queryParams = ['queries', 'search'];
    protected array $parameters = [
        'queries' => ['type' => 'array', 'description' => 'Appwrite Query strings for filtering and pagination.', 'items' => ['type' => 'string']],
        'search' => ['type' => 'string', 'description' => 'Search term for teams.'],
    ];
}
