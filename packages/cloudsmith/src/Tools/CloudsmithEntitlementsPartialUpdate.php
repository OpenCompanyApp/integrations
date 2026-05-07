<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update a specific entitlement in a repository..
 *
 * Maps to the official Cloudsmith endpoint patch /entitlements/{owner}/{repo}/{identifier}/.
 */
class CloudsmithEntitlementsPartialUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_entitlements_partial_update';
    protected const DESCRIPTION = 'Update a specific entitlement in a repository.

Official Cloudsmith endpoint: PATCH /entitlements/{owner}/{repo}/{identifier}/

Update a specific entitlement in a repository.';
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
    protected const METHOD = 'patch';
    protected const PATH = '/entitlements/{owner}/{repo}/{identifier}/';
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
