<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Delete a package license policy..
 *
 * Maps to the official Cloudsmith endpoint delete /orgs/{org}/license-policy/{slug_perm}/.
 */
class CloudsmithOrgsLicensePolicyDelete extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_license_policy_delete';
    protected const DESCRIPTION = 'Delete a package license policy.

Official Cloudsmith endpoint: DELETE /orgs/{org}/license-policy/{slug_perm}/

Delete a package license policy.';
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
);
    protected const METHOD = 'delete';
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
