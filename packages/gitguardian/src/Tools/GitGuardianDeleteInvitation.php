<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Delete an invitation.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/invitations/{invitation_id}.
 */
class GitGuardianDeleteInvitation extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_delete_invitation';
    protected const DESCRIPTION = 'Delete an existing invitation. If you are using a personal access token, you need to have an access level superior or equal to `manager`.

Official GitGuardian endpoint: DELETE /v1/invitations/{invitation_id}.';
    protected const PARAMETERS = [
        'invitation_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the invitation to retrieve',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/invitations/{invitation_id}';
    protected const PATH_PARAMS = [
        'invitation_id' => 'invitation_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
