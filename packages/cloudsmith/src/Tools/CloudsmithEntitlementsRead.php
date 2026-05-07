<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a specific entitlement in a repository..
 *
 * Maps to the official Cloudsmith endpoint get /entitlements/{owner}/{repo}/{identifier}/.
 */
class CloudsmithEntitlementsRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_entitlements_read';
    protected const DESCRIPTION = 'Get a specific entitlement in a repository.

Official Cloudsmith endpoint: GET /entitlements/{owner}/{repo}/{identifier}/

Get a specific entitlement in a repository.';
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
  'fuzzy' => array (
  'type' => 'string',
  'description' => 'If true, entitlement identifiers including name will be fuzzy matched.',
),
  'show_tokens' => array (
  'type' => 'string',
  'description' => 'Show entitlement token strings in results',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/entitlements/{owner}/{repo}/{identifier}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
  'fuzzy' => 'fuzzy',
  'show_tokens' => 'show_tokens',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
