<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Update a member's email settings.
 *
 * Maps to the official GitGuardian endpoint PATCH /v1/members/{member_id}/email_notifications.
 */
class GitGuardianUpdateMemberEmailSettings extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_update_member_email_settings';
    protected const DESCRIPTION = 'Update a member\'s email settings If you are using a personal access token, you need to have access level greater than `member` to edit other member\'s settings

Official GitGuardian endpoint: PATCH /v1/members/{member_id}/email_notifications.';
    protected const PARAMETERS = [
        'member_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the workspace member',
        ],
        'send_email' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether to notify the member about the update.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/members/{member_id}/email_notifications';
    protected const PATH_PARAMS = [
        'member_id' => 'member_id',
    ];
    protected const QUERY_PARAMS = [
        'send_email' => 'send_email',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
