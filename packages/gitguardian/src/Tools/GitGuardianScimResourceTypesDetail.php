<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Resource Types (SCIM).
 *
 * Maps to the official GitGuardian endpoint GET /v1/scim/v2/ResourceTypes/{name}.
 */
class GitGuardianScimResourceTypesDetail extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_scim_resource_types_detail';
    protected const DESCRIPTION = 'Detail of a Resource Types

Official GitGuardian endpoint: GET /v1/scim/v2/ResourceTypes/{name}.';
    protected const PARAMETERS = [
        'name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'name',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/scim/v2/ResourceTypes/{name}';
    protected const PATH_PARAMS = [
        'name' => 'name',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
