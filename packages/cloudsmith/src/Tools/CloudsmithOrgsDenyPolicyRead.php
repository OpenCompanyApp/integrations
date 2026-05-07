<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a package deny policy..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/deny-policy/{slug_perm}/.
 */
class CloudsmithOrgsDenyPolicyRead extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_deny_policy_read';
    protected const DESCRIPTION = 'Get a package deny policy.

Official Cloudsmith endpoint: GET /orgs/{org}/deny-policy/{slug_perm}/

Get a package deny policy.';
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
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/deny-policy/{slug_perm}/';
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
