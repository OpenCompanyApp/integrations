<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Create a group (SCIM).
 *
 * Maps to the official GitGuardian endpoint POST /v1/scim/v2/Groups.
 */
class GitGuardianScimGroupCreate extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_scim_group_create';
    protected const DESCRIPTION = 'Create a new group (team in GIM) using the SCIM Protocol.

Official GitGuardian endpoint: POST /v1/scim/v2/Groups.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/scim/v2/Groups';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/scim+json';
}
