<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Partially update a group (SCIM).
 *
 * Maps to the official GitGuardian endpoint PATCH /v1/scim/v2/Groups/{id}.
 */
class GitGuardianScimGroupPartialUpdate extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_scim_group_partial_update';
    protected const DESCRIPTION = 'Partially update a group (team in GIM) using the SCIM Protocol.

Official GitGuardian endpoint: PATCH /v1/scim/v2/Groups/{id}.';
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
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/scim/v2/Groups/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/scim+json';
}
