<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Retrieve an evaluation request for this policy..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/license-policy/{policy_slug_perm}/evaluation/{slug_perm}/.
 */
class CloudsmithOrgsLicensePolicyEvaluationRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_license_policy_evaluation_read';
    protected const DESCRIPTION = 'Retrieve an evaluation request for this policy.

Official Cloudsmith endpoint: GET /orgs/{org}/license-policy/{policy_slug_perm}/evaluation/{slug_perm}/

Retrieve an evaluation request for this policy.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
  'required' => true,
),
  'policy_slug_perm' => array (
  'type' => 'string',
  'description' => 'policy_slug_perm parameter.',
  'required' => true,
),
  'slug_perm' => array (
  'type' => 'string',
  'description' => 'slug_perm parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/license-policy/{policy_slug_perm}/evaluation/{slug_perm}/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
  'policy_slug_perm' => 'policy_slug_perm',
  'slug_perm' => 'slug_perm',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
