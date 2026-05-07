<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Give a member access to a resource.
 *
 * Maps to the official GitGuardian endpoint PUT /v1/members/{member_id}/{resource_type}/{resource_id}.
 */
class GitGuardianSetMemberResourceAccess extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_set_member_resource_access';
    protected const DESCRIPTION = 'This will create or update a direct access for the member on the resource. If the member has higher permission from another source, they will take precedence over those you have given.

Official GitGuardian endpoint: PUT /v1/members/{member_id}/{resource_type}/{resource_id}.';
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
        'send_email' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether to notify the member about the access.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/members/{member_id}/{resource_type}/{resource_id}';
    protected const PATH_PARAMS = [
        'member_id' => 'member_id',
        'resource_type' => 'resource_type',
        'resource_id' => 'resource_id',
    ];
    protected const QUERY_PARAMS = [
        'send_email' => 'send_email',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
