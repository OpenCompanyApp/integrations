<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Create an invitation.
 *
 * Maps to the official GitGuardian endpoint POST /v1/invitations.
 */
class GitGuardianCreateInvitations extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_create_invitations';
    protected const DESCRIPTION = 'This endpoint allows you to send an invitation to a user. If you are using a personal access token, you need to have an access level superior or equal to `member`.

Official GitGuardian endpoint: POST /v1/invitations.';
    protected const PARAMETERS = [
        'send_email' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether to send an email to the invitee with a link to accept the invitation.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/invitations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'send_email' => 'send_email',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
