<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Create a team.
 *
 * Maps to the official GitGuardian endpoint POST /v1/teams.
 */
class GitGuardianCreateTeams extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_create_teams';
    protected const DESCRIPTION = 'This endpoint allows you to create a team. If you are using a personal access token, you need to have an access level superior or equal to `manager`. If a personal access token is being used, the member is automatically added to the created team with permissions `can_manage` and `full_access`

Official GitGuardian endpoint: POST /v1/teams.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/teams';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
