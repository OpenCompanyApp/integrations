<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Update of a member (SCIM).
 *
 * Maps to the official GitGuardian endpoint PUT /v1/scim/v2/Users/{id}.
 */
class GitGuardianScimUserUpdate extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_scim_user_update';
    protected const DESCRIPTION = 'Update of a workspace member (using SCIM Protocol).

Official GitGuardian endpoint: PUT /v1/scim/v2/Users/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/scim/v2/Users/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/scim+json';
}
