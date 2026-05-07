<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Disable an entitlement token in a repository..
 *
 * Maps to the official Cloudsmith endpoint post /entitlements/{owner}/{repo}/{identifier}/disable/.
 */
class CloudsmithEntitlementsDisable extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_entitlements_disable';
    protected const DESCRIPTION = 'Disable an entitlement token in a repository.

Official Cloudsmith endpoint: POST /entitlements/{owner}/{repo}/{identifier}/disable/

Disable an entitlement token in a repository.';
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
    protected const PATH = '/entitlements/{owner}/{repo}/{identifier}/disable/';
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
