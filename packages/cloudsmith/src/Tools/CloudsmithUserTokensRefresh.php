<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Refresh the specified API key for the user that is currently authenticated..
 *
 * Maps to the official Cloudsmith endpoint put /user/tokens/{slug_perm}/refresh/.
 */
class CloudsmithUserTokensRefresh extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_user_tokens_refresh';
    protected const DESCRIPTION = 'Refresh the specified API key for the user that is currently authenticated.

Official Cloudsmith endpoint: PUT /user/tokens/{slug_perm}/refresh/

Refresh the specified API key for the user that is currently authenticated.';
    protected const PARAMETERS = array (
  'slug_perm' => array (
  'type' => 'string',
  'description' => 'slug_perm parameter.',
  'required' => true,
),
);
    protected const METHOD = 'put';
    protected const PATH = '/user/tokens/{slug_perm}/refresh/';
    protected const PATH_PARAMS = array (
  'slug_perm' => 'slug_perm',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
