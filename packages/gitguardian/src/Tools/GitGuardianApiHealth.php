<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * API Health.
 *
 * Maps to the official GitGuardian endpoint GET /v1/health.
 */
class GitGuardianApiHealth extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_api_health';
    protected const DESCRIPTION = 'Check the status of the API and your token without spending your quota.

Official GitGuardian endpoint: GET /v1/health.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/health';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
