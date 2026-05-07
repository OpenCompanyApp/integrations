<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Delete a team invitation.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/teams/{team_id}/team_invitations/{team_invitation_id}.
 */
class GitGuardianDeleteTeamInvitation extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_delete_team_invitation';
    protected const DESCRIPTION = 'Delete an existing team invitation. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: DELETE /v1/teams/{team_id}/team_invitations/{team_invitation_id}.';
    protected const PARAMETERS = [
        'team_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team',
        ],
        'team_invitation_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the team invitation',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/teams/{team_id}/team_invitations/{team_invitation_id}';
    protected const PATH_PARAMS = [
        'team_id' => 'team_id',
        'team_invitation_id' => 'team_invitation_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
