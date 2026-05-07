<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Detail of a group (SCIM).
 *
 * Maps to the official GitGuardian endpoint GET /v1/scim/v2/Groups/{id}.
 */
class GitGuardianScimGroupDetail extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_scim_group_detail';
    protected const DESCRIPTION = 'Detail of a group (team in GIM) using the SCIM Protocol.

Official GitGuardian endpoint: GET /v1/scim/v2/Groups/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/scim/v2/Groups/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
