<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List Schemas (SCIM).
 *
 * Maps to the official GitGuardian endpoint GET /v1/scim/v2/Schemas.
 */
class GitGuardianScimSchemaList extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_scim_schema_list';
    protected const DESCRIPTION = 'List of SCIM Schemas

Official GitGuardian endpoint: GET /v1/scim/v2/Schemas.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/scim/v2/Schemas';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
