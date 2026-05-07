<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List invitations.
 *
 * Maps to the official GitGuardian endpoint GET /v1/invitations.
 */
class GitGuardianListInvitations extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_invitations';
    protected const DESCRIPTION = 'This endpoint allows you to list all pending invitations. The response contains the list of invitations and a pagination cursor to retrieve the next page. The invitations are sorted by id. If you are using a personal access token, you need to have an access level superior or equal to `member`.

Official GitGuardian endpoint: GET /v1/invitations.';
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
        'search' => [
            'type' => 'string',
            'required' => false,
            'description' => 'search',
        ],
        'ordering' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
            'enum' => ['date', '-date'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/invitations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'per_page' => 'per_page',
        'search' => 'search',
        'ordering' => 'ordering',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
