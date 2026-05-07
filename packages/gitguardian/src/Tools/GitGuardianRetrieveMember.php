<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve a member.
 *
 * Maps to the official GitGuardian endpoint GET /v1/members/{member_id}.
 */
class GitGuardianRetrieveMember extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_retrieve_member';
    protected const DESCRIPTION = 'Retrieve an existing workspace member. If you are using a personal access token, you need to have an access level greater or equal to `member`.

Official GitGuardian endpoint: GET /v1/members/{member_id}.';
    protected const PARAMETERS = [
        'member_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the workspace member',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/members/{member_id}';
    protected const PATH_PARAMS = [
        'member_id' => 'member_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
