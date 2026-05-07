<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Revoke a member's access to a resource.
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/members/{member_id}/{resource_type}/{resource_id}.
 */
class GitGuardianRevokeMemberResourceAccess extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_revoke_member_resource_access';
    protected const DESCRIPTION = 'Revoke a member access to a resource. This only works for direct accesses. If the member has only indirect access, a 404 is returned.

Official GitGuardian endpoint: DELETE /v1/members/{member_id}/{resource_type}/{resource_id}.';
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
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/members/{member_id}/{resource_type}/{resource_id}';
    protected const PATH_PARAMS = [
        'member_id' => 'member_id',
        'resource_type' => 'resource_type',
        'resource_id' => 'resource_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
