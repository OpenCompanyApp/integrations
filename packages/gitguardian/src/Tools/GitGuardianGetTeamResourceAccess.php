<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Check team permission for a resource.
 *
 * Maps to the official GitGuardian endpoint GET /v1/teams/{team_id}/{resource_type}/{resource_id}.
 */
class GitGuardianGetTeamResourceAccess extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_get_team_resource_access';
    protected const DESCRIPTION = 'Return the permission a team has on a resource. For the global team, it will always be the highest possible permission.

Official GitGuardian endpoint: GET /v1/teams/{team_id}/{resource_type}/{resource_id}.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/teams/{team_id}/{resource_type}/{resource_id}';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
        'resource_type' => 'resource_type',
        'resource_id' => 'resource_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
