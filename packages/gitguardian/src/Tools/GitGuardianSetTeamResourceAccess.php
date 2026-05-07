<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Give a team access to a resource.
 *
 * Maps to the official GitGuardian endpoint PUT /v1/teams/{team_id}/{resource_type}/{resource_id}.
 */
class GitGuardianSetTeamResourceAccess extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_set_team_resource_access';
    protected const DESCRIPTION = 'This will create or update a direct access for the team on the resource. If the access to the resource is already given by the team\'s perimeter, an error is raised. This endpoint is not allowed for the global team.

Official GitGuardian endpoint: PUT /v1/teams/{team_id}/{resource_type}/{resource_id}.';
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
        'send_email' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether to notify the team members about the access.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/teams/{team_id}/{resource_type}/{resource_id}';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
        'resource_type' => 'resource_type',
        'resource_id' => 'resource_id',
    ];
    protected const QUERY_PARAMS = [
        'send_email' => 'send_email',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
