<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Check member permission for a resource.
 *
 * Maps to the official GitGuardian endpoint GET /v1/members/{member_id}/{resource_type}/{resource_id}.
 */
class GitGuardianGetMemberResourceAccess extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_get_member_resource_access';
    protected const DESCRIPTION = 'Return the permission a member has on a resource. The permission is the higher value between the different accesses the member can have (direct access, member\'s teams accesses, and administrator access).

Official GitGuardian endpoint: GET /v1/members/{member_id}/{resource_type}/{resource_id}.';
    protected const PARAMETERS = [
        'member_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the workspace member',
        ],
        'resource_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The kind of resource of the access',
            'enum' => ['secret-incidents'],
        ],
        'resource_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the resource of the access',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/members/{member_id}/{resource_type}/{resource_id}';
    protected const PATH_PARAMS = [
        'member_id' => 'member_id',
        'resource_type' => 'resource_type',
        'resource_id' => 'resource_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
