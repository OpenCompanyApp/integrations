<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Revoke an OAuth2 token.
 *
 * Maps to the official LangSmith endpoint POST /oauth/revoke.
 */
class LangSmithPostOauthRevoke extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_oauth_revoke';
    protected const DESCRIPTION = 'Revoke an OAuth2 token

Official endpoint: POST /oauth/revoke
Revokes an access token or refresh token per RFC 7009. Always returns 200 regardless of whether the token was found.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Multipart form fields. Use file_path for a local upload file when required.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/oauth/revoke';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = true;
}
