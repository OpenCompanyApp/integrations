<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Approve OAuth2 authorization request.
 *
 * Maps to the official LangSmith endpoint POST /oauth/authorize/approve.
 */
class LangSmithPostOauthAuthorizeApprove extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_oauth_authorize_approve';
    protected const DESCRIPTION = 'Approve OAuth2 authorization request

Official endpoint: POST /oauth/authorize/approve
Issues an authorization code after the authenticated user approves the request. Called by the frontend consent page. Requires authentication.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'Multipart form fields. Use file_path for a local upload file when required.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/oauth/authorize/approve';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = true;
}
