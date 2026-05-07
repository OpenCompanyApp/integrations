<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a package deny policy..
 *
 * Maps to the official Cloudsmith endpoint post /orgs/{org}/deny-policy/.
 */
class CloudsmithOrgsDenyPolicyCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_deny_policy_create';
    protected const DESCRIPTION = 'Create a package deny policy.

Official Cloudsmith endpoint: POST /orgs/{org}/deny-policy/

Create a package deny policy.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org}/deny-policy/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
