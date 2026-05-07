<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Exchange grant for OAuth2 tokens.
 *
 * Maps to the official LangSmith endpoint POST /oauth/token.
 */
class LangSmithPostOauthToken extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_oauth_token';
    protected const DESCRIPTION = 'Exchange grant for OAuth2 tokens

Official endpoint: POST /oauth/token
Token endpoint that dispatches by grant_type: authorization_code, urn:ietf:params:oauth:grant-type:device_code, or refresh_token.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Multipart form fields. Use file_path for a local upload file when required.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/oauth/token';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = true;
}
