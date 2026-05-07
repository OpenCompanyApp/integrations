<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Reset the statistics for an entitlement token in a repository..
 *
 * Maps to the official Cloudsmith endpoint post /entitlements/{owner}/{repo}/{identifier}/reset/.
 */
class CloudsmithEntitlementsReset extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_entitlements_reset';
    protected const DESCRIPTION = 'Reset the statistics for an entitlement token in a repository.

Official Cloudsmith endpoint: POST /entitlements/{owner}/{repo}/{identifier}/reset/

Reset the statistics for an entitlement token in a repository.';
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
  'show_tokens' => array (
  'type' => 'string',
  'description' => 'Show entitlement token strings in results',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/entitlements/{owner}/{repo}/{identifier}/reset/';
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
