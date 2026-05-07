<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Delete a team.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/teams/{team_id}.
 */
class GitGuardianDeleteTeam extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_delete_team';
    protected const DESCRIPTION = 'Delete an existing team. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager. The "All-incidents" team (is_global=true) cannot be deleted.

Official GitGuardian endpoint: DELETE /v1/teams/{team_id}.';
    protected const PARAMETERS = [
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/teams/{team_id}';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
