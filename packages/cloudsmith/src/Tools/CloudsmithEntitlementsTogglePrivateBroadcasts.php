<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Set private broadcast access for an entitlement token in a repository..
 *
 * Maps to the official Cloudsmith endpoint post /entitlements/{owner}/{repo}/{identifier}/toggle-private-broadcasts/.
 */
class CloudsmithEntitlementsTogglePrivateBroadcasts extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_entitlements_toggle_private_broadcasts';
    protected const DESCRIPTION = 'Set private broadcast access for an entitlement token in a repository.

Official Cloudsmith endpoint: POST /entitlements/{owner}/{repo}/{identifier}/toggle-private-broadcasts/

Set private broadcast access for an entitlement token in a repository.';
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
);
    protected const METHOD = 'post';
    protected const PATH = '/entitlements/{owner}/{repo}/{identifier}/toggle-private-broadcasts/';
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
