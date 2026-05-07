<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Update a package license policy..
 *
 * Maps to the official Cloudsmith endpoint put /orgs/{org}/license-policy/{slug_perm}/.
 */
class CloudsmithOrgsLicensePolicyUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_license_policy_update';
    protected const DESCRIPTION = 'Update a package license policy.

Official Cloudsmith endpoint: PUT /orgs/{org}/license-policy/{slug_perm}/

Update a package license policy.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'slug_perm' => array (
  'type' => 'string',
  'description' => 'slug_perm parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Cloudsmith API schema.',
),
);
    protected const METHOD = 'put';
    protected const PATH = '/orgs/{org}/license-policy/{slug_perm}/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
  'slug_perm' => 'slug_perm',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
