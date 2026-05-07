<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a specific entitlement in a repository..
 *
 * Maps to the official Cloudsmith endpoint post /entitlements/{owner}/{repo}/.
 */
class CloudsmithEntitlementsCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_entitlements_create';
    protected const DESCRIPTION = 'Create a specific entitlement in a repository.

Official Cloudsmith endpoint: POST /entitlements/{owner}/{repo}/

Create a specific entitlement in a repository.';
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
    protected const PATH = '/entitlements/{owner}/{repo}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
);
    protected const QUERY_PARAMS = array (
  'show_tokens' => 'show_tokens',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
