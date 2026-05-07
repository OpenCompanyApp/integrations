<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve a team.
 *
 * Maps to the official GitGuardian endpoint GET /v1/teams/{team_id}.
 */
class GitGuardianRetrieveTeam extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_retrieve_team';
    protected const DESCRIPTION = 'Retrieve an existing team. If you are using a personal access token, you need to have an access level greater or equal to `member`.

Official GitGuardian endpoint: GET /v1/teams/{team_id}.';
    protected const PARAMETERS = [
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/teams/{team_id}';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
