<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Partially update a package deny policy..
 *
 * Maps to the official Cloudsmith endpoint patch /orgs/{org}/deny-policy/{slug_perm}/.
 */
class CloudsmithOrgsDenyPolicyPartialUpdate extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_deny_policy_partial_update';
    protected const DESCRIPTION = 'Partially update a package deny policy.

Official Cloudsmith endpoint: PATCH /orgs/{org}/deny-policy/{slug_perm}/

Partially update a package deny policy.';
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
    protected const METHOD = 'patch';
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
