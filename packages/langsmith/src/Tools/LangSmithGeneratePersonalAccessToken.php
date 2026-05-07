<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Generate Personal Access Token.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/api-key/current.
 */
class LangSmithGeneratePersonalAccessToken extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_generate_personal_access_token';
    protected const DESCRIPTION = 'Generate Personal Access Token

Official endpoint: POST /api/v1/api-key/current
DEPRECATED: Use /orgs/current/personal-access-tokens instead';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/api-key/current';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
