<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve an invitation.
 *
 * Maps to the official GitGuardian endpoint GET /v1/invitations/{invitation_id}.
 */
class GitGuardianRetrieveInvitation extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_retrieve_invitation';
    protected const DESCRIPTION = 'Retrieve an existing invitation. If you are using a personal access token, you need to have an access level superior or equal to `member`.

Official GitGuardian endpoint: GET /v1/invitations/{invitation_id}.';
    protected const PARAMETERS = [
        'invitation_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the invitation to retrieve',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/invitations/{invitation_id}';
    protected const PATH_PARAMS = [
        'invitation_id' => 'invitation_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
