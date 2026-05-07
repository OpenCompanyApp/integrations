<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Revoke a team's access to a resource.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/teams/{team_id}/{resource_type}/{resource_id}.
 */
class GitGuardianRevokeTeamResourceAccess extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_revoke_team_resource_access';
    protected const DESCRIPTION = 'Revoke the access a team has to a resource. This only works for direct accesses. If the access to the resource is given by the team\'s perimeter, an error is raised. This endpoint is not allowed for the global team.

Official GitGuardian endpoint: DELETE /v1/teams/{team_id}/{resource_type}/{resource_id}.';
    protected const PARAMETERS = [
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
        'resource_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The kind of resource of the access',
            'enum' => ['secret-incidents'],
        ],
        'resource_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the resource of the access',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/teams/{team_id}/{resource_type}/{resource_id}';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
        'resource_type' => 'resource_type',
        'resource_id' => 'resource_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
