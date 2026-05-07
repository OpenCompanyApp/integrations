<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Check invitation permission for a resource.
 *
 * Maps to the official GitGuardian endpoint GET /v1/invitations/{invitation_id}/{resource_type}/{resource_id}.
 */
class GitGuardianGetInvitationResourceAccess extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_get_invitation_resource_access';
    protected const DESCRIPTION = 'Return the permission an invitation has on a resource. If the invitation has an admin access level, it will be the highest possible value.

Official GitGuardian endpoint: GET /v1/invitations/{invitation_id}/{resource_type}/{resource_id}.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/invitations/{invitation_id}/{resource_type}/{resource_id}';
    protected const PATH_PARAMS = [
        'invitation_id' => 'invitation_id',
        'resource_type' => 'resource_type',
        'resource_id' => 'resource_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
