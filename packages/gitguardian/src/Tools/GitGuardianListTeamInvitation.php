<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List team invitations.
 *
 * Maps to the official GitGuardian endpoint GET /v1/teams/{team_id}/team_invitations.
 */
class GitGuardianListTeamInvitation extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_team_invitation';
    protected const DESCRIPTION = 'List all existing team invitations. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: GET /v1/teams/{team_id}/team_invitations.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Pagination cursor.',
        ],
        'per_page' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of items to list per page.',
        ],
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
        'invitation_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The id of an invitation to filter on',
        ],
        'is_team_leader' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'is_team_leader',
        ],
        'team_permission' => [
            'type' => 'string',
            'required' => false,
            'description' => 'team_permission',
        ],
        'incident_permission' => [
            'type' => 'string',
            'required' => false,
            'description' => 'incident_permission',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/teams/{team_id}/team_invitations';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'invitation_id' => 'invitation_id',
        'is_team_leader' => 'is_team_leader',
        'team_permission' => 'team_permission',
        'incident_permission' => 'incident_permission',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
