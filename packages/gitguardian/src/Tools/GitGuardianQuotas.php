<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * Quota overview.
 *
 * Maps to the official GitGuardian endpoint GET /v1/quotas.
 */
class GitGuardianQuotas extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_quotas';
    protected const DESCRIPTION = 'Check available scanning calls for this token. Quota is shared between all tokens of a workspace

Official GitGuardian endpoint: GET /v1/quotas.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/quotas';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
