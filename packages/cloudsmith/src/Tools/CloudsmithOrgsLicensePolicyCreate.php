<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Create a package license policy..
 *
 * Maps to the official Cloudsmith endpoint post /orgs/{org}/license-policy/.
 */
class CloudsmithOrgsLicensePolicyCreate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_license_policy_create';
    protected const DESCRIPTION = 'Create a package license policy.

Official Cloudsmith endpoint: POST /orgs/{org}/license-policy/

Create a package license policy.';
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
    protected const PATH = '/orgs/{org}/license-policy/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
