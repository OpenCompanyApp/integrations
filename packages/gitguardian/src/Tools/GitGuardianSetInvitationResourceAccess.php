<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Give an invitation access to a resource.
 *
 * Maps to the official GitGuardian endpoint PUT /v1/invitations/{invitation_id}/{resource_type}/{resource_id}.
 */
class GitGuardianSetInvitationResourceAccess extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_set_invitation_resource_access';
    protected const DESCRIPTION = 'This will create or update a direct access for the invitation on the resource. If the invitation has an administrator access level, it will take precedence over the permission you have given.

Official GitGuardian endpoint: PUT /v1/invitations/{invitation_id}/{resource_type}/{resource_id}.';
    protected const PARAMETERS = [
        'invitation_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The id of the invitation to retrieve',
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
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/invitations/{invitation_id}/{resource_type}/{resource_id}';
    protected const PATH_PARAMS = [
        'invitation_id' => 'invitation_id',
        'resource_type' => 'resource_type',
        'resource_id' => 'resource_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
