<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Enable an entitlement token in a repository..
 *
 * Maps to the official Cloudsmith endpoint post /entitlements/{owner}/{repo}/{identifier}/enable/.
 */
class CloudsmithEntitlementsEnable extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_entitlements_enable';
    protected const DESCRIPTION = 'Enable an entitlement token in a repository.

Official Cloudsmith endpoint: POST /entitlements/{owner}/{repo}/{identifier}/enable/

Enable an entitlement token in a repository.';
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
);
    protected const METHOD = 'post';
    protected const PATH = '/entitlements/{owner}/{repo}/{identifier}/enable/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
  'identifier' => 'identifier',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
