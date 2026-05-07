<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List Resource Types (SCIM).
 *
 * Maps to the official GitGuardian endpoint GET /v1/scim/v2/ResourceTypes.
 */
class GitGuardianScimResourceTypesList extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_scim_resource_types_list';
    protected const DESCRIPTION = 'List of Resource Types

Official GitGuardian endpoint: GET /v1/scim/v2/ResourceTypes.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/scim/v2/ResourceTypes';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
