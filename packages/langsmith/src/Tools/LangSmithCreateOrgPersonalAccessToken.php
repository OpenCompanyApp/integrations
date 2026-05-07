<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Org Personal Access Token.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/personal-access-tokens.
 */
class LangSmithCreateOrgPersonalAccessToken extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_org_personal_access_token';
    protected const DESCRIPTION = 'Create Org Personal Access Token

Official endpoint: POST /api/v1/orgs/current/personal-access-tokens
Create Org Personal Access Token.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/personal-access-tokens';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
