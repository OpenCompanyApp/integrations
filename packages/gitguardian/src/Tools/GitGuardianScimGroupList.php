<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List groups (SCIM).
 *
 * Maps to the official GitGuardian endpoint GET /v1/scim/v2/Groups.
 */
class GitGuardianScimGroupList extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_scim_group_list';
    protected const DESCRIPTION = 'List groups (teams in GIM) of the workspace using the SCIM Protocol.

Official GitGuardian endpoint: GET /v1/scim/v2/Groups.';
    protected const PARAMETERS = [
        'filter' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter groups using the SCIM filtering DSL.',
        ],
        'start_index' => [
            'type' => 'number',
            'required' => false,
            'description' => 'The 1-based index of the first result in the current set of list results.',
        ],
        'count' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Specifies the desired maximum number of query results per page.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/scim/v2/Groups';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'filter' => 'filter',
        'startIndex' => 'start_index',
        'count' => 'count',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
