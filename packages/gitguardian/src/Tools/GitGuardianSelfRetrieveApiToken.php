<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Retrieve details of the current API token..
 *
 * Maps to the official GitGuardian endpoint GET /v1/api_tokens/self.
 */
class GitGuardianSelfRetrieveApiToken extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_self_retrieve_api_token';
    protected const DESCRIPTION = 'Retrieve details of the current API token.

Official GitGuardian endpoint: GET /v1/api_tokens/self.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/api_tokens/self';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
