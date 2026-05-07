<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve a member's email settings.
 *
 * Maps to the official GitGuardian endpoint GET /v1/members/{member_id}/email_notifications.
 */
class GitGuardianRetrieveMemberEmailSettings extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_retrieve_member_email_settings';
    protected const DESCRIPTION = 'Retrieve a member\'s email settings If you are using a personal access token, you need to have access level greater than `member` to view other member\'s settings

Official GitGuardian endpoint: GET /v1/members/{member_id}/email_notifications.';
    protected const PARAMETERS = [
        'member_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the workspace member',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/members/{member_id}/email_notifications';
    protected const PATH_PARAMS = [
        'member_id' => 'member_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
