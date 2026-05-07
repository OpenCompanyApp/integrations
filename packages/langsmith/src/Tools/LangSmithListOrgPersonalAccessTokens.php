<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Org Personal Access Tokens.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/personal-access-tokens.
 */
class LangSmithListOrgPersonalAccessTokens extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_org_personal_access_tokens';
    protected const DESCRIPTION = 'List Org Personal Access Tokens

Official endpoint: GET /api/v1/orgs/current/personal-access-tokens
List Org Personal Access Tokens.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/personal-access-tokens';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
