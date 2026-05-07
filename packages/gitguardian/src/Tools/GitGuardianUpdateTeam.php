<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Update a team.
 *
 * Maps to the official GitGuardian endpoint PATCH /v1/teams/{team_id}.
 */
class GitGuardianUpdateTeam extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_update_team';
    protected const DESCRIPTION = 'Update a team\'s name and/or its description. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager. The "All-incidents" team (is_global=true) cannot be updated.

Official GitGuardian endpoint: PATCH /v1/teams/{team_id}.';
    protected const PARAMETERS = [
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/teams/{team_id}';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
