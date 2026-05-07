<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Delete a specific entitlement in a repository..
 *
 * Maps to the official Cloudsmith endpoint delete /entitlements/{owner}/{repo}/{identifier}/.
 */
class CloudsmithEntitlementsDelete extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_entitlements_delete';
    protected const DESCRIPTION = 'Delete a specific entitlement in a repository.

Official Cloudsmith endpoint: DELETE /entitlements/{owner}/{repo}/{identifier}/

Delete a specific entitlement in a repository.';
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
    protected const METHOD = 'delete';
    protected const PATH = '/entitlements/{owner}/{repo}/{identifier}/';
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
