<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Refresh an entitlement token in a repository..
 *
 * Maps to the official Cloudsmith endpoint post /entitlements/{owner}/{repo}/{identifier}/refresh/.
 */
class CloudsmithEntitlementsRefresh extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_entitlements_refresh';
    protected const DESCRIPTION = 'Refresh an entitlement token in a repository.

Official Cloudsmith endpoint: POST /entitlements/{owner}/{repo}/{identifier}/refresh/

Refresh an entitlement token in a repository.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'repo' => array (
  'type' => 'string',
  'description' => 'repo parameter.',
  'required' => true,
),
  'identifier' => array (
  'type' => 'string',
  'description' => 'identifier parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
  'show_tokens' => array (
  'type' => 'string',
  'description' => 'Show entitlement token strings in results',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/entitlements/{owner}/{repo}/{identifier}/refresh/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
  'show_tokens' => 'show_tokens',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
