<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List SCIM tokens.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/orgs/current/scim/tokens.
 */
class LangSmithGetV1PlatformOrgsCurrentScimTokens extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_orgs_current_scim_tokens';
    protected const DESCRIPTION = 'List SCIM tokens

Official endpoint: GET /v1/platform/orgs/current/scim/tokens
List all SCIM bearer tokens for the current organization. The full token values are not returned.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/orgs/current/scim/tokens';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
