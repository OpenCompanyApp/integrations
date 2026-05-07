<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Revoke the current API token..
 *
 * Maps to the official GitGuardian endpoint DELETE /v1/api_tokens/self.
 */
class GitGuardianSelfDeleteApiToken extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_self_delete_api_token';
    protected const DESCRIPTION = 'Revoke the current API token.

Official GitGuardian endpoint: DELETE /v1/api_tokens/self.';
    protected const PARAMETERS = [];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/api_tokens/self';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
