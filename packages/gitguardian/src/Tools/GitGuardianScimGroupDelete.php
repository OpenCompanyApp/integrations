<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Delete a group (SCIM).
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/scim/v2/Groups/{id}.
 */
class GitGuardianScimGroupDelete extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_scim_group_delete';
    protected const DESCRIPTION = 'Delete a group (team in GIM) using the SCIM Protocol.

Official GitGuardian endpoint: DELETE /v1/scim/v2/Groups/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/scim/v2/Groups/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
