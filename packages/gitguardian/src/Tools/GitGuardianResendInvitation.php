<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Resend an invitation.
 *
 * Maps to the official GitGuardian endpoint POST /v1/invitations/{invitation_id}/resend.
 */
class GitGuardianResendInvitation extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_resend_invitation';
    protected const DESCRIPTION = 'Resend an existing invitation. If you are using a personal access token, you need to have an access level superior or equal to `manager`.

Official GitGuardian endpoint: POST /v1/invitations/{invitation_id}/resend.';
    protected const PARAMETERS = [
        'invitation_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the invitation to retrieve',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/invitations/{invitation_id}/resend';
    protected const PATH_PARAMS = [
        'invitation_id' => 'invitation_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
