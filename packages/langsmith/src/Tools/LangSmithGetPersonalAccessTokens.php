<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Personal Access Tokens.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/api-key/current.
 */
class LangSmithGetPersonalAccessTokens extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_personal_access_tokens';
    protected const DESCRIPTION = 'Get Personal Access Tokens

Official endpoint: GET /api/v1/api-key/current
DEPRECATED: Use /orgs/current/personal-access-tokens instead';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/api-key/current';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
